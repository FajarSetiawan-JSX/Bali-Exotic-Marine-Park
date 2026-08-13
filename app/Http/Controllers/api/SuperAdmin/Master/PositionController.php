<?php

namespace App\Http\Controllers\api\SuperAdmin\Master;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Master\Division\GetPositionResource;
use App\Models\Division;
use App\Models\DivisionPosition;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $division)
    {
        $positions = DivisionPosition::with('position', 'division')->whereHas('division', function ($query) use ($division) {
            $query->where('id', '=', $division);
        })->whereHas('division.level', function ($query) {
            $query->where('level', '!=', 1);
        });
        if ($request->filled('search')) {
            $positions = $positions->where('name', 'like', '%' . $request->search . '%');
        }
        $positions = $positions->paginate(6)->withQueryString();
        return GetPositionResource::collection($positions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $slug)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|unique:division_positions,id',
            'position' => 'required|exists:positions,id'
        ], [
            'required' => 'The :attribute is required',
            'unique' => ':attribute already exist',
            'exists' => 'The :attribute id is not found'
        ])->validate();
        DB::beginTransaction();
        try {
            $division = Division::where('slug', '=', $slug)->first();
            if (!$division) {
                abort(404);
            }
            $position = DivisionPosition::create([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'position_id' => $valid['position'],
                'division_id' => $division->id
            ]);

            $user = Auth::user();
            $user->log()->create([
                'log' => 'Create position ' . $position->name
            ]);
            DB::commit();
            return response()->json(['message' => 'Success create new position']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new position',
                'file' => 'Controller : api/SuperAdmin/Master/PositionController.php',
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
            'name' => 'required|unique:division_positions,id',
            'position' => 'required|exists:positions,id'
        ], [
            'required' => 'The :attribute is required',
            'unique' => ':attribute already exist',
            'exists' => 'The :attribute id is not found'
        ])->validate();
        DB::beginTransaction();
        try {
            $position = DivisionPosition::where('id', '=', $id)->first();
            $position->update([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'position_id' => $valid['position'],
            ]);
            $user = Auth::user();
            $user->log()->create([
                'log' => 'Update position'
            ]);
            DB::commit();
            return response()->json(['message' => 'Success update position']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Update position',
                'file' => 'Controller : api/SuperAdmin/Master/PositionController.php',
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
        $divisionPosition = DivisionPosition::where('id', '=', $id)->first();
        if (!$divisionPosition) {
            return response()->json(['message' => 'Position not found'], 404);
        }
        DB::beginTransaction();
        try {
            $name = $divisionPosition->name;
            $divisionPosition->delete();
            $user = Auth::user();
            $user->log()->create([
                'log' => 'Delete position' . $name
            ]);
            DB::commit();
            return response()->json(['message' => 'Success delete position']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Delete position',
                'file' => 'Controller : api/SuperAdmin/Master/PositionController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }
}
