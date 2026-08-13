<?php

namespace App\Http\Controllers\api\SuperAdmin\Master;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Master\Division\GetDivisionsResource;
use App\Models\Division;
use App\Models\SessionWork;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\PseudoTypes\False_;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $division = Division::where('level_id', '!=', 1)->with('level', 'unit', 'position.user');
        if ($request->filled('search')) {
            $division = $division->where('name', 'like', '%' . $request->search . '%');
        }
        return GetDivisionsResource::collection($division->paginate(6)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|unique:divisions,name',
            'level' => 'required|exists:levels,id',
            'unit' => 'required|exists:units,id',
            'worktime' => 'required|exists:work_times,id',
            'description' => 'nullable|max:200'
        ], [
            'required' => 'The field :attribute require.',
            'unique' => ':attribute division name is already registered.',
            'exists' => 'The value of :attribute is not exist',
            'max' => 'maximum character length 100',
        ])->validate();
        DB::beginTransaction();
        try {
            $division = Division::create([
                'level_id' => $valid['level'],
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'description' => $valid['description']
            ]);
            $division->unit()->create([
                'unit_id' => $valid['unit']
            ]);
            $division->worktime()->create([
                'work_time_id' => $valid['worktime'],
                'work' => TRUE
            ]);
            $division->worktime()->create([
                'work_time_id' => $valid['worktime'],
                'work' => False
            ]);

            $user = Auth::user();
            $user->log()->create([
                'log' => 'Create division ' . $division->name
            ]);
            DB::commit();
            return response()->json(['message' => 'Success create new division']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new division',
                'file' => 'Controller : api/SuperAdmin/Master/DivisionController.php',
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
            'name' => 'required|unique:divisions,name,' . $id,
            'level' => 'required|exists:levels,id',
            'unit' => 'required|exists:units,id',
            'worktime' => 'required|exists:work_times,id',
            'description' => 'nullable|max:200'
        ], [
            'required' => 'The field :attribute require.',
            'unique' => ':attribute division name is already registered.',
            'exists' => 'The value of :attribute is not exist',
            'max' => 'maximum character length 100',
        ])->validate();
        DB::beginTransaction();
        try {
            $division = Division::where('id', '=', $id)->first();
            $division->unit()->delete();
            $division->worktime()->delete();
            $division->update([
                'level_id' => $valid['level'],
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'description' => $valid['description']
            ]);
            $division->unit()->create([
                'unit_id' => $valid['unit']
            ]);
            $division->worktime()->create([
                'work_time_id' => $valid['worktime'],
                'work' => TRUE
            ]);
            $division->worktime()->create([
                'work_time_id' => $valid['worktime'],
                'work' => False
            ]);
            $user = Auth::user();
            $user->log()->create([
                'log' => 'Update division'
            ]);
            DB::commit();
            return response()->json(['message' => 'Success update division']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Update division',
                'file' => 'Controller : api/SuperAdmin/Master/DivisionController.php',
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

        return response()->json(['message' => 'Maintenance']);
    }
}
