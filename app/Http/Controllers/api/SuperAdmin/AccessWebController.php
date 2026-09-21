<?php

namespace App\Http\Controllers\api\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\GetWebAccessResource;
use App\Models\DivisionPosition;
use App\Models\Permission_web;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AccessWebController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $id)
    {
        $access = Permission_web::where('division_position_id', '=', $id)->with(['web.methode'])->paginate(6)->withQueryString();
        return GetWebAccessResource::collection($access);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        $valid = Validator::make($request->all(), [
            'web' => 'required|array|min:1',
            '*web' => 'exists:webs,id'
        ], [
            'required' => 'field web is required',
            'array' => 'Input must be array data type',
            'min' => 'Select at least one item of option',
            'exists' => 'web ID not found'
        ])->validate();
        $divisionposition = DivisionPosition::where('id', '=', $id)->with(['web'])->first();
        if (!$divisionposition) {
            return response()->json(['message' => 'Division Position ID not found!'], 404);
        }
        DB::beginTransaction();
        try {
            $divisionposition->web()->delete();
            foreach ($valid['web'] as $web) {
                $divisionposition->web()->create([
                    'web_id' => $web
                ]);
            }
            DB::commit();
            return response()->json(['message' => 'Success']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new user',
                'file' => 'Controller : api/SuperAdmin/AcessWebController.php',
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
        $web = Permission_web::where('id', '=', $id)->first();
        if (!$web) {
            return response()->json(['message' => 'Permission ID not found!'], 404);
        }
        $web->delete();
        return response()->json(['message' => 'Success']);
    }
}
