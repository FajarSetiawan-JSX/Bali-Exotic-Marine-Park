<?php

namespace App\Http\Controllers\api\Specific;

use App\Http\Controllers\Controller;
use App\Http\Resources\Specific\GetDietPlanResource;
use App\Http\Resources\Specific\GetDietPlansResource;
use App\Models\DietPlan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class DietController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $diets = DietPlan::orderBy('created_at', 'desc')->with(['basic.templete.user', 'basic.date', 'mamal', 'approve.basic.templete.user', 'approve.execute']);
        if ($request->filled('from') || $request->filled('to')) {
            $diets = $diets->whereBetween('created_at', [$request->from, $request->to]);
        }
        return GetDietPlansResource::collection($diets->paginate(6)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'basic' => 'required|exists:basic_information,id',
            'mamal'   => 'required|exists:mamals,id',
            'gelatin' => 'required|decimal:0,2|min:0|max:1000',
            'selar'   => 'required|decimal:0,2|min:0|max:1000',
            'layang'  => 'required|decimal:0,2|min:0|max:1000',
            'total'   => 'required|decimal:0,2|min:0|max:1000',
        ], [
            'required' => ':attribute is required.',
            'exists'   => ':attribute is invalid.',
            'decimal'  => ':attribute must have a maximum of 2 decimal places.',
            'min'      => ':attribute must be at least :min.',
            'max'      => ':attribute may not be greater than :max.',
        ])->validate();
        DB::beginTransaction();
        try {
            $data = DietPlan::create([
                'basic_information_id' => $valid['basic'],
                'mamal_id' => $valid['mamal'],
                'gelatin' => $valid['gelatin'],
                'selar' => $valid['selar'],
                'layang' => $valid['layang'],
                'total' => $valid['total']
            ]);
            $data->load(['basic.templete.user', 'basic.date', 'mamal', 'approve.basic.templete.user', 'approve.execute']);
            $user = Auth::user();
            $user->log()->create([
                'log' => $user->name .  ' Create new diet plan at ' . now()
            ]);
            DB::commit();
            return new GetDietPlanResource($data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new diet plan',
                'file' => 'Controller : api/Specific/DietControllerController.php',
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
        $valid = Validator::make($request->all(), [
            'mamal'   => 'required|exists:mamals,id',
            'gelatin' => 'required|decimal:0,2|min:0|max:1000',
            'selar'   => 'required|decimal:0,2|min:0|max:1000',
            'layang'  => 'required|decimal:0,2|min:0|max:1000',
            'total'   => 'required|decimal:0,2|min:0|max:1000',
        ], [
            'required' => ':attribute is required.',
            'exists'   => ':attribute is invalid.',
            'decimal'  => ':attribute must have a maximum of 2 decimal places.',
            'min'      => ':attribute must be at least :min.',
            'max'      => ':attribute may not be greater than :max.',
        ])->validate();
        $diet = DietPlan::where('id', '=', $id)->first();
        if (!$diet) {
            return response()->json(['message' => 'Diet plan ID not found!'], 404);
        }
        DB::beginTransaction();
        try {
            $diet->update([
                'mamal_id' => $valid['mamal'],
                'gelatin' => $valid['gelatin'],
                'selar' => $valid['selar'],
                'layang' => $valid['layang'],
                'total' => $valid['total']
            ]);
            $diet->load(['basic.templete.user', 'basic.date', 'mamal', 'approve.basic.templete.user', 'approve.execute.basic.templete.user']);
            $user = Auth::user();
            $user->log()->create([
                'log' => $user->name .  ' Update diet plan at ' . now()
            ]);
            DB::commit();
            return new GetDietPlanResource($diet);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Update diet plan',
                'file' => 'Controller : api/Specific/DietControllerController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    public function approve(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'basic' => 'required|exists:basic_information,id'
        ], [
            'required' => 'Basic information is required',
            'exists' => 'Basic information does not exists'
        ])->validate();
        $diet = DietPlan::where('id', '=', $id)->with(['basic.templete.user', 'basic.date', 'mamal', 'approve.basic.templete.user', 'approve.execute.basic.templete.user'])->first();
        if (!$diet) {
            return response()->json(['message' => 'Diet plan ID not found!'], 404);
        }
        if ($diet->approve()->exists()) {
            return response()->json(['message' => 'Diet plan has been approved'], 409);
        }
        DB::beginTransaction();
        try {
            $diet->approve()->create([
                'basic_information_id' => $valid['basic']
            ]);
            $user = Auth::user();
            $user->log()->create([
                'log' => $user->name .  ' Approved diet plan at ' . now()
            ]);
            DB::commit();
            return new GetDietPlanResource($diet);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Approve diet plan',
                'file' => 'Controller : api/Specific/DietControllerController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    public function execute($id, Request $request){
        $valid = Validator::make($request->all(), [
            'basic' => 'required|exists:basic_information,id',
            'gelatin' => 'required|decimal:0,2|min:0|max:1000',
            'selar'   => 'required|decimal:0,2|min:0|max:1000',
            'layang'  => 'required|decimal:0,2|min:0|max:1000',
            'total'   => 'required|decimal:0,2|min:0|max:1000',
        ], [
            'required' => ':attribute is required.',
            'exists'   => ':attribute is invalid.',
            'decimal'  => ':attribute must have a maximum of 2 decimal places.',
            'min'      => ':attribute must be at least :min.',
            'max'      => ':attribute may not be greater than :max.',
        ])->validate();
        $diet = DietPlan::where('id', '=', $id)->with(['basic.templete.user', 'basic.date', 'mamal', 'approve.basic.templete.user', 'approve.execute'])->first();
        if (!$diet) {
            return response()->json(['message' => 'Diet plan ID not found!'], 404);
        }
        if (!$diet->approve()->exists()) {
            return response()->json(['message' => 'Please approve the diet plan first'], 409);
        }
        if ($diet->approve->execute) {
            return response()->json([
                'message' => 'Diet plan has already been executed.'
            ], 409);
        }
        DB::beginTransaction();
        try {
            $diet->approve->execute()->create([
                'basic_information_id' => $valid['basic'],
                'gelatin' => $valid['gelatin'],
                'selar' => $valid['selar'],
                'layang' => $valid['layang'],
                'total' => $valid['total']
            ]);
            $diet->load(['basic.templete.user', 'basic.date', 'mamal', 'approve.basic.templete.user', 'approve.execute.basic.templete.user']);
            $user = Auth::user();
            $user->log()->create([
                'log' => $user->name .  ' Create new diet plan at ' . now()
            ]);
            DB::commit();
            return new GetDietPlanResource($diet);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Intake diet plan',
                'file' => 'Controller : api/Specific/DietControllerController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
