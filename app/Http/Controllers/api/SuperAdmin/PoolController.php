<?php

namespace App\Http\Controllers\api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\GetPoolsResource;
use App\Models\Pool;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class PoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pools = Pool::orderBy('created_at', 'desc');
        if ($request->filled('search')) {
            $pools = $pools->where('name', 'like', '%' . $request->search . '%');
        }
        return GetPoolsResource::collection($pools->paginate(10)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|unique:pools,name',
            'length' => 'nullable|numeric|min:1|max:10000|decimal:0,2',
            'width' => 'nullable|numeric|min:1|max:10000|decimal:0,2',
            'height' => 'nullable|numeric|min:1|max:10000|decimal:0,2',
        ], [
            'required' => 'Pool name is required',
            'unique' => 'Pool name is already exists',
            'numeric' => ':attribute must be numeric',
            'decimal' => ':attribute must be decimal',
            'max' => ':attribute max is 10000cm',
            'min' => ':attribute min is 1cm'
        ])->validate();
        DB::beginTransaction();
        try {
            $data = Pool::create([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'width' => $valid['width'],
                'length' => $valid['length'],
                'height' => $valid['height']
            ]);
            DB::commit();
            return response()->json(['data' => $data]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new pool',
                'file' => 'Controller : api/SuperAdmin/PoolController.php',
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
            'name' => 'required|unique:pools,name,' . $id,
            'length' => 'nullable|numeric|min:1|max:10000|decimal:0,2',
            'width' => 'nullable|numeric|min:1|max:10000|decimal:0,2',
            'height' => 'nullable|numeric|min:1|max:10000|decimal:0,2',
        ], [
            'required' => 'Pool name is required',
            'unique' => 'Pool name is already exists',
            'numeric' => ':attribute must be numeric',
            'decimal' => ':attribute must be decimal',
            'max' => ':attribute max is 10000cm',
            'min' => ':attribute min is 1cm'
        ])->validate();
        $pool = Pool::where('id', '=', $id)->first();
        if (!$pool) {
            return response()->json(['message' => 'Pool ID not found!'], 404);
        }
        DB::beginTransaction();
        try {
            $pool->update([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'width' => $valid['width'],
                'length' => $valid['length'],
                'height' => $valid['height']
            ]);
            DB::commit();
            return response()->json(['message' => 'Success update pool']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Update pool',
                'file' => 'Controller : api/SuperAdmin/PoolController.php',
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
        $pool = Pool::where('id', '=', $id)->first();
        if (!$pool) {
            return response()->json(['message' => 'Pool ID not found!'], 404);
        }
        $pool->delete();
    }
}
