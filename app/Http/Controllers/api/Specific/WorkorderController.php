<?php

namespace App\Http\Controllers\api\Specific;

use App\Http\Controllers\Controller;
use App\Http\Resources\Specific\GetWorkordersResource;
use App\Models\AssignSupervisor;
use App\Models\Division;
use App\Models\WorkOrder;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class WorkorderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $workorders = WorkOrder::orderBy('created_at', 'desc')->with(['spv', 'basic.templete.user']);
        if ($request->filled('from') & $request->filled('to')) {
            $from = $request->from;
            $to = $request->to;
            $workorders = $workorders->whereHas('basic.date', function ($q) use ($from, $to) {
                $q->whereBetween('date', [$from, $to]);
            });
        }
        return GetWorkordersResource::collection($workorders->paginate(6)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'basic' => 'required|exists:basic_information,id',
            'item' => 'required|string',
            'status' => 'required|in:Ganti,Maintenance,Penambahan',
            'remark' => 'nullable|string|max:200',
            'img' => 'nullable|mimes:png,jpg,jpeg|max:2048'
        ], [
            'required' => ':attribute is required.',
            'exists' => ':attribute is invalid.',
            'string' => ':attribute must be a string.',
            'in' => ':attribute is invalid.',
            'max' => ':attribute maximum is 2MB for images and 200 characters for text.',
            'mimes' => ':attribute must be a PNG, JPG, or JPEG file.',
        ])->validate();
        $user = Auth::user();
        $division = Division::where('name', '=', $user->getdivision())->first();
        $assign = AssignSupervisor::where('division_id', '=', $division->id)->with(['user'])->first();
        if (!$assign) {
            return response()->json(['message' => 'The division is not assigned by Supervisor!'], 409);
        }
        DB::beginTransaction();
        try {
            $path = null;
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('workorder', 'public');
            }
            $data = WorkOrder::create([
                'basic_information_id' => $valid['basic'],
                'spv_id' => $assign->user->id,
                'item' => $valid['item'],
                'status' => $valid['status'],
                'remark' => $valid['remark'],
                'img' => $path
            ]);
            $data->load('spv', 'basic.templete.user');
            $user->log()->create([
                'log' => 'create new work order at ' . now()->format('d-m-Y')
            ]);
            DB::commit();
            return response()->json(['data' => $data]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new work order',
                'file' => 'Controller : api/Specific/WorkorderController.php',
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
