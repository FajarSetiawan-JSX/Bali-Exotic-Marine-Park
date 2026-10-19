<?php

namespace App\Http\Controllers\api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\GetBookingMethodesResource;
use App\Models\BookingMethode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MethodeBookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bookingmethodes = bookingMethode::orderBy('created_at', 'desc');
        if ($request->filled('search')) {
            $bookingmethodes = $bookingmethodes->where('name', 'like', '%' . $request->search . '%');
        }
        return GetBookingMethodesResource::collection($bookingmethodes->paginate(10)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(),[
            'name' => 'required|unique:booking_methodes,name',
            'description' => 'nullable|string|max:200'
        ],[
            'required' => ':attribute is required',
            'string' => 'Format input must be string',
            'name.unique' => 'Name already taken',
            'description.max' => 'Description max 200 characters'
        ])->validate();
        DB::beginTransaction();
        try {
            $data = BookingMethode::create([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'description' => $valid['description']
            ]);
            DB::commit();
            return response()->json(['data' => $data]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new booking methode',
                'file' => 'Controller : api/SuperAdmin/BookingMethodeController.php',
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
    public function update(Request $request, $id)
    {
        $valid = Validator::make($request->all(),[
            'name' => 'required|unique:booking_methodes,name,' . $id,
            'description' => 'nullable|string|max:200'
        ],[
            'required' => ':attribute is required',
            'string' => 'Format input must be string',
            'name.unique' => 'Name already taken',
            'description.max' => 'Description max 200 characters'
        ])->validate();
        DB::beginTransaction();
        try {
            $data = BookingMethode::where('id', '=', $id)->first();
            $data->update([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'description' => $valid['description']
            ]);
            DB::commit();
            return response()->json(['data' => $data]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Update booking methode',
                'file' => 'Controller : api/SuperAdmin/BookingMethodeController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = BookingMethode::where('id', '=', $id)->first();
        DB::beginTransaction();
        try {
            $data->delete();
            DB::commit();
            return response()->json(['message' => 'Success delete booking methode']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Delete booking methode',
                'file' => 'Controller : api/SuperAdmin/BookingMethodeController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }
}
