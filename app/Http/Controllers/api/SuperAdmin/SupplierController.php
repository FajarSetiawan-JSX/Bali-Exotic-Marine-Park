<?php

namespace App\Http\Controllers\api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\GetSuppliersResource;
use App\Http\Resources\GetSupervisorResource;
use App\Models\Supplier;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $suppliers = Supplier::orderBy('created_at', 'desc');
        if ($request->filled('search')) {
            $suppliers = $suppliers->where('name', 'like', '%' . $request->search . '%');
        }
        return GetSuppliersResource::collection($suppliers->paginate(10)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|unique:suppliers,name',
            'address' => 'nullable|string|max:200'
        ], [
            'required' => 'Field name is required',
            'unique' => 'Name is already registered',
            'string' => ':attribute must be string',
            'max' => 'maximal length 200 charachters'
        ])->validate();
        DB::beginTransaction();
        try {
            $supplier = Supplier::create([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'address' => $valid['address']
            ]);
            DB::commit();
            return response()->json(['data' => $supplier]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new area',
                'file' => 'Controller : api/SuperAdmin/SupplierController.php',
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
            'name' => 'required|unique:suppliers,name,' . $id,
            'address' => 'nullable|string|max:200'
        ], [
            'required' => 'Field name is required',
            'unique' => 'Name is already registered',
            'string' => ':attribute must be string',
            'max' => 'maximal length 200 charachters'
        ])->validate();
        DB::beginTransaction();
        try {
            $supplier = Supplier::where('id', '=', $id)->first();
            $supplier->update([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'address' => $valid['address']
            ]);
            DB::commit();
            return response()->json(['message' => 'Success Upadate']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Update Supplier',
                'file' => 'Controller : api/SuperAdmin/SupplierController.php',
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
        DB::beginTransaction();
        try {
            $supplier = Supplier::where('id', '=', $id)->first();
            $supplier->delete();
            DB::commit();
            return response()->json(['message' => 'Success Delete']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Delete Supplier',
                'file' => 'Controller : api/SuperAdmin/SupplierController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }
}
