<?php

namespace App\Http\Controllers\api\Specific;

use App\Http\Controllers\Controller;
use App\Http\Resources\Specific\GetBookingResource;
use App\Http\Resources\Specific\GetBookingsResource;
use App\Models\Booking;
use App\Models\Date;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bookings = Booking::orderBy('created_at', 'desc')->orderBy('name', 'asc')->with(['guide', 'methode_booking', 'order.program.program', 'basic.templete.user']);
        if ($request->filled('search')) {
            $bookings = $bookings->where('name', 'like', '%' . $request->search . '%');
        }
        if ($request->today == true && $request->filled('basic')) {
            $basic = $request->basic;
            $date = Date::whereHas('basic', function ($q) use ($basic) {
                $q->where('id', '=', $basic);
            })->first();
            $bookings = $bookings->where('activity', '=', $date->date);
        }
        return GetBookingsResource::collection($bookings->paginate(10)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'nullable|email',
            'whatsapp' => 'nullable|digits_between:9,13',
            'qty' => 'required|integer|min:1',
            'date' => 'required|date',
            'booking' => 'required|exists:booking_methodes,id',
            'basic' => 'required|exists:basic_information,id',
            'payment' => 'required|in:NETT,OTA,50%,100%',
            'guide' => 'nullable|string',
            'order' => 'required|array|min:1',
            'order.*.program' => 'required|exists:program_categories,id',
            'order.*.session' => 'required|in:09:30,10:00,10:30,11:30,12:00,13:00,14:00,15:00,16:00',
        ], [
            'required' => ':attribute is required',
            'string' => ':attribute must be a text',
            'email' => ':attribute must be a valid email',
            'digits_between' => ':attribute must be 9 to 13 digits',
            'integer' => ':attribute must be a whole number',
            'date' => ':attribute must be a valid date',
            'exists' => ':attribute is not valid',
            'in' => ':attribute must be one of the available options',
            'min' => ':attribute must be at least :min',
            'order.required' => 'Select at least one program',
            'order.min' => 'Select at least one program',
            'order.*.program.required' => 'Program is required',
            'order.*.program.exists' => 'Program is not valid',
            'order.*.session.required' => 'Session is required',
            'order.*.session.in' => 'Session must be one of the available options',
        ])->validate();
        if (!$valid['email'] && !$valid['whatsapp']) {
            return response()->json(['message' => 'email or whatsApp is required']);
        }
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $hash = hash_hmac('sha256', $valid['whatsapp'], config('app.key'));
            $data = Booking::create([
                'basic_information_id' => $valid['basic'],
                'name' => $valid['name'],
                'email' => $valid['email'],
                'whatsapp' => encrypt($valid['whatsapp']),
                'whatsapp_hash' => $hash,
                'methode_booking_id' => $valid['booking'],
                'payment' => $valid['payment'],
                'activity' => $valid['date']
            ]);
            foreach ($valid['order'] as $order) {
                $data->order()->create([
                    'program_category_id' => $order['program'],
                    'session' => $order['session']
                ]);
            };
            if ($valid['guide']) {
                $data->guide()->create([
                    'name' => $valid['guide']
                ]);
            }
            $data->load(['guide', 'methode_booking', 'order.program.program', 'basic.templete.user']);
            $user->log()->create([
                'log' => 'create new booking at ' . now()
            ]);
            DB::commit();
            return new GetBookingResource($data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new booking',
                'file' => 'Controller : api/Specific/BookingController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $booking = Booking::where('id', '=', $id)->first();
        if (!$booking) {
            return response()->json(['message' => 'Booking ID not found!'], 404);
        }
        $booking->delete();
        return response()->json(['message' => 'Success delete booking']);
    }
}
