<?php

namespace App\Http\Controllers\api\SuperAdmin\Schedule;

use App\Http\Controllers\Controller;
use App\Models\Time;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class TimeController extends Controller
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
        //
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
            'name' => 'required|string|unique:times,name,' . $id,
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i|after:start',
            'break_start' => 'required|date_format:H:i',
            'break_end' => 'required|date_format:H:i|after:break_start'
        ], [
            'name.unique' => 'A time entry with this name already exists.',
            'start.date_format' => 'Start time format is invalid.',
            'end.date_format' => 'End time format is invalid.',
            'end.after' => 'End time must be later than start time.',
            'break_start.date_format' => 'Break start format is invalid.',
            'break_end.date_format' => 'Break end format is invalid.',
            'break_end.after' => 'Break end time must be later than break start time.',
        ])->validate();
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $time = Time::where('id', '=', $id)->first();
            $time->update([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'start' => $valid['start'],
                'end' => $valid['end'],
                'break_start' => $valid['break_start'],
                'break_end' => $valid['break_end']
            ]);
            $user->log()->create([
                'log' => 'Update full time schedule ' . now()
            ]);
            DB::commit();
            return response()->json(['message' => 'Success update full time']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Update time full time',
                'file' => 'Controller : api/SuperAdmin/Schedule/TimeController.php',
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
        $data = Time::where('id', '=', $id)->first();
        if (!$data) {
            return response()->json(['message' => 'Time not found'], 404);
        }
        $data->delete();
        return response()->json(['message' => 'Time deleted successfully']);
    }
}
