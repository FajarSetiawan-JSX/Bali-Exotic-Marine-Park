<?php

namespace App\Http\Controllers\api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetSupervisorResource;
use App\Models\AssignSupervisor;
use App\Models\Division;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SupervisorAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::whereHas('divisionPosition.divisionPosition.division.level', function ($query) {
            $query->where('level', '=', 2);
        })->with('division')->get();
        $result = $user->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'division' => $user->getdivision(),
                'position' => $user->getposition(),
                'assign' => $user->division()->get()->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'division' => $item->division->name,
                    ];
                })
            ];
        });

        $total = User::count();
        $divisions = Division::doesntHave('assign')->whereHas('level', function ($query) {
            $query->where('level', '=', 3);
        })->with(['level'])->get();
        $divisions = $divisions->map(function ($item) use ($total) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'level' => $item->level->level,
                'description' => $item->description ? Str::limit($item->description, 20) : 'No Description',
                'user' => $item->getuser()->count(),
                'total' => $total,
                'percentage' => floor(($item->getuser()->count() / $total) * 100),

            ];
        });

        return response()->json(['supervisors' => $result, 'divisions' => $divisions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'supervisor' => 'required|exists:users,id',
            'divisions' => 'required|array',
            'divisions.*' => 'exists:divisions,id'
        ], [
            'supervisor.required' => 'Supervisor is required',
            'supervisor.exists' => 'Supervisor not found',
            'divisions.required' => 'Divisions is required',
            'divisions.array' => 'Divisions must be an array',
            'divisions.*.exists' => 'Division not found'
        ])->validate();
        DB::beginTransaction();
        try {
            $supervisor = User::findOrFail($request->supervisor);
            foreach ($valid['divisions'] as $division) {
                $supervisor->division()->create([
                    'division_id' => $division
                ]);
            }
            DB::commit();
            return response()->json(['message' => 'Supervisor assigned successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to assign supervisor', 'error' => $e->getMessage()], 500);
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
        $division = AssignSupervisor::findOrFail($id);
        $division->delete();
        return response()->json(['message' => 'Division detached successfully']);
    }
}
