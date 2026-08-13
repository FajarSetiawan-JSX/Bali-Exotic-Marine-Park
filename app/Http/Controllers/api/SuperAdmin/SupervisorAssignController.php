<?php

namespace App\Http\Controllers\api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\GetSupervisorResource;
use App\Models\Division;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupervisorAssignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::whereHas('division.level', function ($query) {
            $query->where('level', '=', 2);
        })->with(['position.assign', 'division'])->get();
        $supervisor = $data->map(function ($item) {
            return [
                'id' => $item->id,
                'division' => $item->division->name,
                'nama' => $item->name,
                'position' => $item->position()->get()->map(function ($data) {
                    return [
                        'id' => $data->id,
                        'position' => $data->position->name,
                        'assign' => $data->assign()->get()->map(function ($item) {
                            return [
                                'id' => $item->id,
                                'division' => $item->division->name
                            ];
                        })
                    ];
                })
            ];
        });

        $total = User::count();
        $divisions = Division::doesntHave('supervisor')->whereHas('level', function ($query) {
            $query->where('level', '=', 3);
        })->with(['level', 'user'])->get();
        $divisions = $divisions->map(function ($item) use ($total) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'level' => $item->level->level,
                'description' => $item->description ? Str::limit($item->description, 20) : 'No Description',
                'user' => $item->user()->count(),
                'total' => $total,
                'percentage' => floor(($item->user()->count() / $total) * 100),

            ];
        });

        return response()->json(['supervisors' => $supervisor, 'divisions' => $divisions]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
