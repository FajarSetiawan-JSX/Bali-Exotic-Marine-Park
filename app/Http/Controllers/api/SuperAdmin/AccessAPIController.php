<?php

namespace App\Http\Controllers\api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\GetAPIAccessResource;
use App\Models\DivisionPosition;
use App\Models\Permission_api;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AccessAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $access = Permission_api::where('division_position_id', '=', $id)->with(['api.methode'])->paginate(6)->withQueryString();
        return GetAPIAccessResource::collection($access);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'api' => 'required|array|min:1',
            '*api' => 'exists:apis,id'
        ], [
            'required' => 'field api is required',
            'array' => 'Input must be array data type',
            'min' => 'Select at least one item of option',
            'exists' => 'api ID not found'
        ])->validate();
        $divisionposition = DivisionPosition::where('id', '=', $id)->with(['api'])->first();
        if (!$divisionposition) {
            return response()->json(['message' => 'Division Position ID not found!'], 404);
        }
        DB::beginTransaction();
        try {
            $divisionposition->api()->delete();
            foreach ($valid['api'] as $api) {
                $divisionposition->api()->create([
                    'api_id' => $api
                ]);
            }
            DB::commit();
            return response()->json(['message' => 'Success']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new user',
                'file' => 'Controller : api/SuperAdmin/AcessAPIController.php',
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $api = Permission_api::where('id', '=', $id)->first();
        if (!$api) {
            return response()->json(['message' => 'Permission ID not found!'], 404);
        }
        $api->delete();
        return response()->json(['message' => 'Success']);
    }
}
