<?php

namespace App\Http\Controllers\api\SuperAdmin\Schedule;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Schedule\GetShiftingResource;
use App\Models\Time;
use App\Models\WorkTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ShiftingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $time = Time::whereHas('worktime', function ($query) {
            $query->where('name', '=', 'Shifting');
        })->get();
        return GetShiftingResource::collection($time);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'name' => 'required|string|unique:times,name',
            'start' => 'required|date_format:H:i',
            'end' => 'required|date_format:H:i',
            'break_start' => 'required|date_format:H:i',
            'break_end' => 'required|date_format:H:i|after:break_start'
        ], [
            'name.unique' => 'A time entry with this name already exists.',
            'start.date_format' => 'Start time format is invalid.',
            'end.date_format' => 'End time format is invalid.',
            'break_start.date_format' => 'Break start format is invalid.',
            'break_end.date_format' => 'Break end format is invalid.',
            'break_end.after' => 'Break end time must be later than break start time.',
        ])->validate();
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $fulltime = WorkTime::where('name', '=', 'Shifting')->first();
            $fulltime->time()->create([
                'name' => $valid['name'],
                'slug' => Str::slug($valid['name']),
                'start' => $valid['start'],
                'end' => $valid['end'],
                'break_start' => $valid['break_start'],
                'break_end' => $valid['break_end']
            ]);
            $user->log()->create([
                'log' => 'Add division to shifting at ' . now()
            ]);
            DB::commit();
            return response()->json(['message' => 'Success create new user']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Add division to shifting',
                'file' => 'Controller : api/SuperAdmin/Schedule/ShiftingController.php',
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
