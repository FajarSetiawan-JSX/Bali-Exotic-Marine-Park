<?php

namespace App\Http\Controllers\api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\GetProgramCategoriesResource;
use App\Http\Resources\Admin\GetProgramCategoryResource;
use App\Models\ProgramCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ProgramCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $programcategories = ProgramCategory::orderBy('created_at', 'desc')->with(['program']);
        if ($request->filled('search')) {
            $cari = $request->search;
            $programcategories = $programcategories->where('category', 'like', '%' . $cari . '%')->orWhereHas('program', function ($query) use ($cari) {
                $query->where('name', 'like', '%' . $cari . '%');
            });
        }
        return GetProgramCategoriesResource::collection($programcategories->paginate(10)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'program' => 'required|exists:programs,id',
            'category' => 'required|string',
            'price' => 'required'
        ], [
            'required' => 'The :attribute field is required',
            'string' => ':attribute must be string',
            'exists' => 'Program is not exists'
        ])->validate();
        $cek = ProgramCategory::where('program_id', '=', $valid['program'])->where('category', '=', $valid['category'])->exists();
        if ($cek) {
            return response()->json(['message' => 'Program Available is exists'], 409);
        }
        DB::beginTransaction();
        try {
            $data = ProgramCategory::create([
                'program_id' => $valid['program'],
                'category' => $valid['category'],
                'price' => $valid['price']
            ]);
            $data->load('program');
            DB::commit();
            return new GetProgramCategoryResource($data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new program category',
                'file' => 'Controller : api/SuperAdmin/ProgramCategoryControllerController.php',
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
            'program' => 'required|exists:programs,id',
            'category' => 'required|string',
            'price' => 'required'
        ], [
            'required' => 'The :attribute field is required',
            'string' => ':attribute must be string',
            'exists' => 'Program is not exists'
        ])->validate();
        $data = ProgramCategory::where('id', '=', $id)->first();
        if (!$data) {
            return response()->json(['message' => 'Program Available not found!'], 404);
        }
        DB::beginTransaction();
        try {
            $data->update([
                'program_id' => $valid['program'],
                'category' => $valid['category'],
                'price' => $valid['price']
            ]);
            DB::commit();
            return response()->json(['message' => 'Success Update Program Available']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Update program category',
                'file' => 'Controller : api/SuperAdmin/ProgramCategoryControllerController.php',
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
        $data = ProgramCategory::where('id', '=', $id)->first();
        if (!$data) {
            return response()->json(['message' => 'Program Available not found!'], 404);
        }
        DB::beginTransaction();
        try {
            $data->delete();
            DB::commit();
            return response()->json(['message' => 'Success Delete Program Available']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Delete program category',
                'file' => 'Controller : api/SuperAdmin/ProgramCategoryControllerController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }
}
