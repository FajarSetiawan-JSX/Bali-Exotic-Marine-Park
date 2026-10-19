<?php

namespace App\Http\Controllers\api\Specific;

use App\Http\Controllers\Controller;
use App\Http\Resources\Specific\GetDeliveriesResource;
use App\Http\Resources\Specific\GetDeliveryResource;
use App\Models\Delivery;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $deliveries = Delivery::orderBy('created_at', 'desc')->with(['basic.templete.user', 'basic.date']);
        if($request->filled('search')){
            $deliveries = $deliveries->where('name', 'like', '%' . $request->search . '%');
        }
        if($request->filled('from') && $request->filled('to')){
            $from = $request->from;
            $to = $request->to;
            $deliveries = $deliveries->whereHas('basic.date', function($q)use($from, $to){
                $q->whereBetween('date', [$from, $to]);
            });
        }
        return GetDeliveriesResource::collection($deliveries->paginate(10)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'basic' => 'required|exists:basic_information,id',
            'name' => 'required|string',
            'sender' => 'required|string',
            'type' => 'required|in:Personal,Other Parties',
            'information' => 'nullable|string|max:200',
            'img' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ], [
            'required' => ':attribute is required.',
            'exists' => ':attribute is invalid.',
            'string' => ':attribute must be a string.',
            'in' => ':attribute is invalid.',
            'max' => ':attribute maximum is 2MB for files and 200 characters for text.',
            'file' => ':attribute must be a valid file.',
            'mimes' => ':attribute must be a JPG, JPEG, or PNG'
        ])->validate();
        DB::beginTransaction();
        try {
            $path = null;
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('delivery', 'public');
            }
            $data = Delivery::create([
                'basic_information_id' => $valid['basic'],
                'receiver' => $valid['name'],
                'sender' => $valid['sender'],
                'type' => $valid['type'],
                'information' => $valid['information'],
                'img' => $path
            ]);
            $data->load('basic.templete.user', 'basic.date');
            $user = Auth::user();
            $user->log()->create([
                'log' => $user->name .  ' Create new delivery at ' . now()
            ]);
            DB::commit();
            return new GetDeliveryResource($data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new delivery',
                'file' => 'Controller : api/Specific/DeliveryController.php',
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
    public function destroy(string $id)
    {
        //
    }
}
