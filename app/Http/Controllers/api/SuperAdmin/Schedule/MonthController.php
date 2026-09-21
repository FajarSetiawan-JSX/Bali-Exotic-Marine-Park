<?php

namespace App\Http\Controllers\api\SuperAdmin\Schedule;

use App\Http\Controllers\Controller;
use App\Http\Resources\General\GetMonthResource;
use App\Models\Date;
use App\Models\Month;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MonthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $monthnow = now()->format('Y-m');
        $month = Month::where('month', '=', $monthnow)->with(['date.schedule', 'date.schedule.templete.divisionworktime.division'])->firstOrFail();
        if ($request->filled('search')) {
        }
        return new GetMonthResource($month);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'month' => 'required|unique:months,month'
        ], [
            'required' => 'Month is required',
            'unique' => 'An entry month has already been made for this year.'
        ])->validate();
        DB::beginTransaction();
        try {
            $month = Month::create([
                'month' => $valid['month']
            ]);
            $periode = Carbon::createFromFormat('Y-m', $valid['month']);
            for ($i = 1; $i <= $periode->daysInMonth; $i++) {
                $month->date()->create([
                    'date' => Carbon::create($periode->year, $periode->month, $i)->toDateString(),
                ]);
            }
            DB::commit();
            return response()->json(['month' => $month]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Generate date',
                'file' => 'Controller : api/SuperAdmin/Schedule/MonthController.php',
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
        DB::beginTransaction();
        try {
            $user = Auth::user();
            $month = Month::where('id', '=', $id)->firstOrFail();
            $month->delete();
            $user->log()->create([
                'log' => 'Deleting the monthly schedule for ' . $month->month
            ]);
            DB::commit();
            return response()->json(['message' => 'successfully deleted the monthly schedule']);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error([
                'title' => 'Generate date',
                'file' => 'Controller : api/SuperAdmin/Schedule/MonthController.php',
                'pesan' => $e->getMessage(),
                'baris' => $e->getLine()
            ]);
            return response()->json(['message' => 'Server Error'], 500);
        }
    }
}
