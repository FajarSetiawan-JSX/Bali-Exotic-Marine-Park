<?php

namespace App\Http\Controllers\api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\GetAreaResource;
use App\Models\Area;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $areas = Area::query();
        if ($request->filled('search')) {
            $areas = $areas->where('name', 'like', '%' . $request->search . '%');
        }
        $areas = $areas->paginate(10)->withQueryString();
        return GetAreaResource::collection($areas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(),[
            'name' => 'required|unique:areas,name',
            'description' => 'nullable|max:200'
        ],[
            'required' => ':attribute is required',
            'unique' => ':attribute already exists',
            'max' => 'Maximum length of 200 characters'
        ])->validate();
        DB::beginTransaction();
        try {
            $area = Area::create([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'description' => $valid['description']
            ]);
            DB::commit();
            return response()->json(['data' => $area]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new area',
                'file' => 'Controller : api/SuperAdmin/AreaController.php',
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
        $valid = Validator::make($request->all(),[
            'name' => 'required|unique:areas,name,' . $id,
            'description' => 'nullable|max:200'
        ],[
            'required' => ':attribute is required',
            'unique' => ':attribute already exists',
            'max' => 'Maximum length of 200 characters'
        ])->validate();
        DB::beginTransaction();
        try {
            $area = Area::findOrFail($id);
            $area->update([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'description' => $valid['description']
            ]);
            DB::commit();
            return response()->json(['message' => 'Success']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Update area',
                'file' => 'Controller : api/SuperAdmin/AreaController.php',
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
        $area = Area::findOrFail($id);
        $area->delete();
        return response()->json(['message' => 'Success delete']);
    }
}
