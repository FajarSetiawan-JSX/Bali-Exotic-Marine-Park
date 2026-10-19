<?php

namespace App\Http\Controllers\api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\GetContractsResource;
use App\Models\Contract;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $contracts = Contract::orderBy('created_at', 'desc');
        if ($request->filled('search')) {
            $contracts = $contracts->where('name', 'like', '%' . $request->search . '%');
        }
        return GetContractsResource::collection($contracts->paginate(10)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|unique:contracts,name',
            'duration' => 'required|numeric',
            'description' => 'nullable|string|max:200'
        ], [
            'required' => ':attribute field is required.',
            'unique'   => ':attribute already exists.',
            'numeric'  => ':attribute must be numeric.',
            'string'   => ':attribute must be text.',
            'max'      => ':attribute maximal 200 characters.',
        ])->validate();
        DB::beginTransaction();
        try {
            $data = Contract::create([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'duration' => $valid['duration'],
                'description' => $valid['description']
            ]);
            DB::commit();
            return response()->json(['data' => $data]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new contract',
                'file' => 'Controller : api/SuperAdmin/ContractController.php',
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
            'name' => 'required|unique:contracts,name,' . $id,
            'duration' => 'required|numeric',
            'description' => 'nullable|string|max:200'
        ], [
            'required' => ':attribute field is required.',
            'unique'   => ':attribute already exists.',
            'numeric'  => ':attribute must be numeric.',
            'string'   => ':attribute must be text.',
            'max'      => ':attribute maximal 200 characters.',
        ])->validate();
        $data = Contract::where('id', '=', $id)->first();
        if (!$data) {
            return response()->json(['message' => 'ID Contract not found!'], 404);
        }
        DB::beginTransaction();
        try {
            $data->update([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'duration' => $valid['duration'],
                'description' => $valid['description']
            ]);
            DB::commit();
            return response()->json(['message' => 'Success update contract']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Update contract',
                'file' => 'Controller : api/SuperAdmin/ContractController.php',
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
        $data = Contract::where('id', '=', $id)->first();
        if (!$data) {
            return response()->json(['message' => 'ID Contract not found!'], 404);
        }
        DB::beginTransaction();
        try {
            $data->delete();
            DB::commit();
            return response()->json(['message' => 'Success delete contract']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Delete contract',
                'file' => 'Controller : api/SuperAdmin/ContractController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }
}
