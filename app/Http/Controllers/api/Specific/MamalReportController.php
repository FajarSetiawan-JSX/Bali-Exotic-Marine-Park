<?php

namespace App\Http\Controllers\api\Specific;

use App\Http\Controllers\Controller;
use App\Http\Resources\Specific\GetMamalReportResource;
use App\Http\Resources\Specific\GetMamalReportsResource;
use App\Models\Date;
use App\Models\MamalsReport;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MamalReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $reports = MamalsReport::orderBy('created_at', 'desc')->with(['basic.templete.user', 'mamal', 'basic.date', 'mamalreportvet.program', 'mamalreportvet.basic.templete.user', 'mamalreportvet.basic.date']);
        if ($request->filled('from') && $request->filled('to')) {
            $from = $request->from;
            $to = $request->to;
            $reports = $reports->whereHas('basic.date', function ($q) use ($from, $to) {
                $q->whereBetween('date', [$from, $to]);
            });
        }
        if ($request->filled('basic')) {
            $id = $request->basic;
            $date = Date::whereHas('basic', function($query)use($id){
                $query->where('id', '=', $id);
            })->first();
            $reports = $reports->whereHas('basic.date', function($q)use($date){
                $q->where('date', '=', $date->date);
            });
        }
        return GetMamalReportsResource::collection($reports->paginate(10)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'basic' => 'required|exists:basic_information,id',
            'mamal' => 'required|exists:mamals,id',
            'diet' => 'required|numeric|decimal:0,2|min:1|max:1000',
            'frquency' => 'required|numeric|min:1|max:1000',
            'faces' => 'required|numeric|decimal:0,2|min:1|max:1000',
            'floating' => 'required|numeric|decimal:0,2|min:1|max:1000',
            'attentive' => 'required|string|max:200',
            'skin' => 'required|string|max:200',
            'eye' => 'required|string|max:200',
            'remark' => 'nullable|string|max:200'
        ], [
            'required' => ':attribute is required',
            'exists' => ':attribute does not exist',
            'numeric' => ':attribute must be a number',
            'decimal' => ':attribute must have a maximum of 2 decimal places',
            'min' => ':attribute minimum is 1',
            'max' => ':attribute maximum is 1000',
            'string' => ':attribute must be a string',
        ])->validate();
        DB::beginTransaction();
        try {
            $data = MamalsReport::create([
                'basic_information_id' => $valid['basic'],
                'mamal_id' => $valid['mamal'],
                'diet' => $valid['diet'],
                'breathe' => $valid['frquency'],
                'faces' => $valid['faces'],
                'floating' => $valid['floating'],
                'attentive' => $valid['attentive'],
                'skin' => $valid['skin'],
                'eyes' => $valid['eye'],
                'remark' => $valid['remark'] ?? null,
            ]);
            $data->load(['basic.templete.user', 'mamal', 'basic.date', 'mamalreportvet.program', 'mamalreportvet.basic.templete.user', 'mamalreportvet.basic.date']);
            $user = Auth::user();
            $user->log()->create([
                'log' => 'create new mamal report at ' . now()->format('d-m-Y')
            ]);
            DB::commit();
            return new GetMamalReportResource($data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new mamal report',
                'file' => 'Controller : api/Specific/MammalReportController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    public function vetstore(Request $request, $id){
        $valid = Validator::make($request->all(),[
            'basic' => 'required|exists:basic_information,id',
            'group' => 'required|in:A,B',
            'healthstatus' => 'required|in:FIT,FIT RINGAN,KURANG FIT',
            'klinis' => 'required|string',
            'keterangan' => 'nullable|string',
            'socialstatus' => 'required|in:STABLE, NOT STABLE',
            'recomended' => 'required|exists:programs,id',
            'status' => 'required|in:GO, NO GO',
            'remark' => 'nullable|string'
        ],[
            'required' => ':attribute is required.',
            'exists' => 'Selected :attribute is invalid.',
            'in' => 'Selected :attribute is invalid.',
            'string' => ':attribute must be a string.',
        ])->validate();
        $data = MamalsReport::where('id', '=', $id)->first();
        if(!$data){
            return response()->json(['message' => 'Mammal Report ID not found'], 404);
        }
        DB::beginTransaction();
        try {
            $data->mamalreportvet()->create([
                'basic_information_id' => $valid['basic'],
                'program_id' => $valid['recomended'],
                'group' => $valid['group'],
                'health' => $valid['healthstatus'],
                'klinis' => $valid['klinis'],
                'status' => $valid['status'],
                'social' => $valid['socialstatus'],
                'additional' => $valid['keterangan'],
                'remark' => $valid['remark']
            ]);
            $data->load(['basic.templete.user', 'mamal', 'basic.date', 'mamalreportvet.program', 'mamalreportvet.basic.templete.user', 'mamalreportvet.basic.date']);
            $user = Auth::user();
            $user->log()->create([
                'log' => 'create new mamal report at ' . now()->format('d-m-Y')
            ]);
            DB::commit();
            return new GetMamalReportResource($data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new mamal report VET',
                'file' => 'Controller : api/Specific/MammalReportController.php',
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
