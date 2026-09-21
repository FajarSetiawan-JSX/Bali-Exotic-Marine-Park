<?php

namespace App\Http\Controllers\api\Specific;

use App\Http\Controllers\Controller;
use App\Models\DivisionPosition;
use App\Models\Month;
use App\Models\Schedule;
use App\Models\User;
use App\Models\UserDivisionPosition;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ScheduleController extends Controller
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
            'user' => 'required|exists:users,id',
            'month' => 'required|exists:months,id',
            'schedule' => 'required|array|min:1',
            'schedule.*' => 'required|array',
            'schedule.*.date' => 'required|integer|distinct|exists:dates,id',
            'schedule.*.templete' => 'required|integer|exists:templetes,id',
        ], [
            'required' => ':attribute is required',
            'exists' => 'ID :attribute does not exists',
            'schedule.required' => 'time is required',
            'schedule.array' => 'time must be an array',
            'schedule.min' => 'time schedule cannot be empty',
            'schedule.*.date.required' => 'date is required',
            'schedule.*.date.distinct' => 'date cannot be duplicated',
            'schedule.*.date.exists' => 'ID date does not exist',
            'schedule.*.templete.required' => 'templete must be selected',
            'schedule.*.templete.exists' => 'ID templete does not exist',
        ])->validate();
        $month = Month::with('date')->where('id', '=', $valid['month'])->first();
        if (count($valid['schedule']) !== $month->date()->count()) {
            return response()->json(['message' => 'Field not complete'], 409);
        }
        $user = User::where('id', '=', $valid['user'])->first();
        $schedule = Schedule::whereHas('date.month', function ($query) use ($month) {
            $query->where('id', '=', $month->id);
        })->whereHas('templete.user', function ($q) use ($user) {
            $q->where('id', '=', $user->id);
        });
        if ($schedule->exists()) {
            return response()->json(['message' => 'Can not duplicate schedule'], 409);
        }
        DB::beginTransaction();
        try {
            $creator = Auth::user();
            foreach ($valid['schedule'] as $schedule) {
                Schedule::create([
                    'date_id' => $schedule['date'],
                    'templete_id' => $schedule['templete']
                ]);
            }
            $creator->log()->create([
                'log' => 'make a monthly schedule for ' . $month->month . ' for ' . $user->name
            ]);
            DB::commit();
            return response()->json(['data' => $user]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Create new schedule',
                'file' => 'Controller : api/Specific/ScheduleController.php',
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
