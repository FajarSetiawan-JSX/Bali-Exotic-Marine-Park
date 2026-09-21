<?php

namespace App\Http\Controllers\api\General;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AbsenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'schedule' => 'required|exists:schedules,id',
            'reason' => 'required|string',
            'additional' => 'nullable|max:100',
            'img' => 'nullable|file|mimes:jpg,jpeg,png|max:2048'
        ], [
            'required' => ':attribute is required.',
            'string' => ':attribute must be text.',
            'exists' => ':attribute does not exist.',
            'max' => 'maximal 2MB',
            'file' => ':attribute must be file.',
            'mimes' => ':attribute must be jpg, jpeg or png',
        ])->validate();
        DB::beginTransaction();
        try {
            $schedule = Schedule::where('id', '=', $valid['schedule'])->with(['templete.user'])->first();
            $user = User::where('id', '=', $schedule->templete->user->id)->first();
            $path = null;
            if ($request->hasFile('img')) {
                $path = $request->file('img')->store('absen', 'public');
            }
            $schedule->absen()->create([
                'reason' => $valid['reason'],
                'information' => $valid['additional'],
                'img' => $path
            ]);
            $user->log()->create([
                'log' => $user->name .  'Create not attendence because ' . $valid['reason']
            ]);
            DB::commit();
            return response()->json(['message' => 'Success create new not attendence']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new absen',
                'file' => 'Controller : api/General/AbsenController.php',
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
    public function destroy(string $id)
    {
        //
    }
}
