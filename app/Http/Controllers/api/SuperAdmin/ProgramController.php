<?php

namespace App\Http\Controllers\api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\GetProgramsResource;
use App\Models\Program;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $programs = Program::orderBy('created_at', 'desc');
        if ($request->filled('search')) {
            $programs = $programs->where('name', 'like', '%' . $request->search . '%');
        }
        return GetProgramsResource::collection($programs->paginate(10)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|string|unique:programs,name',
            'description' => 'nullable|string|max:200'
        ], [
            'required' => 'The :attribute field is required',
            'string' => ':attribute must be string',
            'unique' => 'The name of program already exists',
            'max' => 'Description is too long, max 200 characters'
        ])->validate();
        DB::beginTransaction();
        try {
            $data = Program::create([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'description' => $valid['description']
            ]);
            DB::commit();
            return response()->json(['data' => $data]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new program',
                'file' => 'Controller : api/SuperAdmin/ProgramControllerController.php',
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
            'name' => 'required|string|unique:programs,name,' . $id,
            'description' => 'nullable|string|max:200'
        ], [
            'required' => 'The :attribute field is required',
            'string' => ':attribute must be string',
            'unique' => 'The name of program already exists',
            'max' => 'Description is too long, max 200 characters'
        ])->validate();
        $data = Program::where('id', '=', $id)->first();
        if (!$data) {
            return response()->json(['message' => 'ID program not found!'], 404);
        }
        DB::beginTransaction();
        try {
            $data->update([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'description' => $valid['description']
            ]);
            DB::commit();
            return response()->json(['message' => 'Success update program']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Update Program',
                'file' => 'Controller : api/SuperAdmin/ProgramControllerController.php',
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
        $data = Program::where('id', '=', $id)->first();
        if (!$data) {
            return response()->json(['message' => 'ID program not found!'], 404);
        }
        DB::beginTransaction();
        try {
            $data->delete();
            DB::commit();
            return response()->json(['message' => 'Success delete program']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Delete Program',
                'file' => 'Controller : api/SuperAdmin/ProgramControllerController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }
}
