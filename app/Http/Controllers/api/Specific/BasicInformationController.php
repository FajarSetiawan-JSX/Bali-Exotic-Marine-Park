<?php

namespace App\Http\Controllers\api\Specific;

use App\Http\Controllers\Controller;
use App\Http\Resources\General\GetBasicInformationResource;
use App\Http\Resources\General\GetBasicInformationsResource;
use App\Models\AssignSupervisor;
use App\Models\BasicInformation;
use App\Models\Date;
use App\Models\Division;
use App\Models\Templete;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BasicInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $basics = BasicInformation::orderBy('created_at', 'desc');
        $user = Auth::user();
        if ($user->getlevel() == 2) {
            $divisionsID = AssignSupervisor::where('id', '=', $user->id)->pluck('division_id');
            $basics->whereIn('division_id', $divisionsID);
        } else {
            $templets = Templete::where('user_id', '=', $user->id)->pluck('id');
            $basics = $basics->whereIn('templete_id', $templets);
        }
        $basics = $basics->with(['date', 'division', 'templete.user', 'templete.templetetime.time', 'additional', 'visitor', 'patrol'])->paginate(10)->withQueryString();
        return GetBasicInformationsResource::collection($basics);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'templete' => 'required|exists:templetes,id',
            'handover' => 'required|boolean',
            'detail' => 'nullable|string|max:200'
        ], [
            'required' => ':attribute is required',
            'exists' => 'Templete does not exist',
            'boolean' => 'handover must be boolean',
            'string' => 'Detail must be string',
            'max' => 'Detail text is 200 characters length max'
        ])->validate();
        $user = Auth::user();
        $division = Division::where('name', '=', $user->getdivision())->first();
        $date = Date::where('date', '=', now()->format('Y-m-d'))->first();
        if (!$date) {
            return response()->json(['message' => 'No Schedule available'], 409);
        }
        $cek = BasicInformation::where('date_id', '=', $date->id)->where('templete_id', '=', $valid['templete'])->where('division_id', '=', $division->id);
        if ($cek->exists()) {
            return response()->json(['message' => 'Basic Information today is already exist'], 409);
        }
        DB::beginTransaction();
        try {
            $basic = $date->basic()->create([
                'division_id' => $division->id,
                'templete_id' => $valid['templete'],
                'handover' => $valid['handover']
            ]);
            if ($valid['detail']) {
                $basic->additional()->create([
                    'detail' => $valid['detail']
                ]);
            }
            $basic->load(['date', 'division', 'templete.user', 'templete.templetetime.time', 'additional', 'visitor', 'patrol']);
            $user->log()->create([
                'log' => $user->name .  ' Create new basic information at ' . $date->date
            ]);
            DB::commit();
            return new GetBasicInformationResource($basic);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new abasic information',
                'file' => 'Controller : api/Specific/BasicInformationController.php',
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

    public function done($id)
    {
        $basic = BasicInformation::where('id', '=', $id)->first();
        if (!$basic) {
            return response()->json(['message' => 'Basic Information not found'], 404);
        }
        $basic->update([
            'done' => true
        ]);
        return response()->json(['message', 'Success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
