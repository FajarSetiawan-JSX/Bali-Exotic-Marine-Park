<?php

namespace App\Http\Controllers;

use App\Models\Month;
use App\Models\Notification;
use App\Models\Schedule;
use App\Models\Time;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SpecificRoutingController extends Controller
{
    public function scheduleCreate($user, $month)
    {
        $user = User::findOrFail($user);
        $month = Month::with('date')->findOrFail($month);
        $users = User::whereHas('divisionPosition.divisionPosition.division', function ($query) use ($user) {
            $query->where('name', '=', $user->getdivision());
        })->whereDoesntHave('templete.schedule.date.month', function ($query) use ($month) {
            $query->where('id', '=', $month->id);
        })->with(['templete.templetetime'])->get();
        return Inertia::render('Specific/ScheduleCreate', ['users' => $users, 'month' => $month]);
    }
    public function reschedule($id)
    {
        $schedule = Schedule::where('id', '=', $id)->first();
        if (!$schedule) {
            abort(404, 'Schedule not found');
        }
        return Inertia::render('Specific/RescheduleCreate', ['schedule' => $schedule]);
    }
    public function visitor()
    {
        return Inertia::render('Specific/Security/Visitor');
    }
    public function bookings()
    {
        return Inertia::render('Specific/Booking');
    }
    public function incidents()
    {
        return Inertia::render('Specific/Incident');
    }
    public function notification()
    {
        $total = Notification::count();
        return Inertia::render('Specific/Notification', ['total' => $total]);
    }
    public function workorders()
    {
        return Inertia::render('Specific/WorkOrder');
    }
    public function order()
    {
        return Inertia::render('Specific/Order');
    }
    public function diets()
    {
        return Inertia::render('Specific/Diets');
    }
    public function mamalreport(){
        return Inertia::render('Specific/MammalReport');
    }
}
