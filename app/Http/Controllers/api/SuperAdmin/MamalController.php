<?php

namespace App\Http\Controllers\api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\GetMammalResource;
use App\Http\Resources\Admin\GetMammalsResource;
use App\Models\Mamals;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MamalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $mamals = Mamals::orderBy('name', 'asc');
        if ($request->filled('search')) {
            $mamals = $mamals->where('name', 'like', '%' . $request->search . '%');
        }
        return GetMammalsResource::collection($mamals->paginate(9)->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|unique:mamals,name',
            'description' => 'nullable|string|max:200',
            'img' => 'nullable|mimes:png,jpg,jpeg|max:2048'
        ], [
            'required' => ':attribute is required',
            'unique' => ':attribute already exists',
            'string' => ':attribute must be a string',
            'description.max' => ':attribute maximum 200 characters',
            'mimes' => ':attribute must be a PNG or JPG file',
            'img.max' => ':attribute maximum size is 2 MB',
        ])->validate();
        DB::beginTransaction();
        try {
            $img = null;
            if ($request->hasFile('img')) {
                $img = $request->file('img')->store('mamal', 'public');
            }
            $data = Mamals::create([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'description' => $valid['description'],
                'img' => $img
            ]);
            DB::commit();
            return new GetMammalResource($data);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new mamal',
                'file' => 'Controller : api/SuperAdmin/MamalController.php',
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
            'name' => 'required|unique:mamals,name,' . $id,
            'description' => 'nullable|string|max:200',
            'img' => 'nullable|mimes:png,jpg,jpeg,PNG,JPG,JPEG|max:2048'
        ], [
            'required' => ':attribute is required',
            'unique' => ':attribute already exists',
            'string' => ':attribute must be a string',
            'description.max' => ':attribute maximum 200 characters',
            'mimes' => ':attribute must be a PNG or JPG file',
            'img.max' => ':attribute maximum size is 2 MB',
        ])->validate();
        $data = Mamals::where('id', '=', $id)->first();
        if (!$data) {
            return response()->json(['message' => 'Mamal not found'], 404);
        }
        DB::beginTransaction();
        try {
            $old = $data->img;
            $img = null;
            if ($request->hasFile('img')) {
                $img = $request->file('img')->store('mamal', 'public');
            }
            $data = Mamals::where('id', '=', $id)->first();
            $data->update([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'description' => $valid['description'],
                'img' => $img
            ]);
            if ($old) {
                Storage::disk('public')->delete($old);
            }
            DB::commit();
            return response()->json(['message' => 'Success update mamal']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Update mamal',
                'file' => 'Controller : api/SuperAdmin/MamalController.php',
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
        $data = Mamals::where('id', '=', $id)->first();
        if (!$data) {
            return response()->json(['message' => 'Mamal not found'], 404);
        }
        DB::beginTransaction();
        try {
            if($data->img){
                Storage::disk('public')->delete($data->img);
            }
            $data->delete();
            DB::commit();
            return response()->json(['message' => 'Success delete mamal']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Delete mamal',
                'file' => 'Controller : api/SuperAdmin/MamalController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }
}
