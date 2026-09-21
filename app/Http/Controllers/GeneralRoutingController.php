<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\DivisionPosition;
use App\Models\Level;
use App\Models\Month;
use App\Models\Templete;
use App\Models\User;
use App\Models\WorkTime;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralRoutingController extends Controller
{
    public function dashboard()
    {
        $levels = Level::with(['division'])->get();
        $datalevel = [];
        foreach ($levels as $level) {
            $datalevel[] = $level->division()->count();
        }
        $label = [];
        $data = [];
        $divisions = Division::get();
        foreach ($divisions as $divisi) {
            $label[] = $divisi->name;
            $data[] = $divisi->getuser()->count();
        }
        $user = User::count();
        return Inertia::render('Dashboard', ['datalevel' => $datalevel, 'label' => $label, 'data' => $data, 'user' => $user]);
    }

    public function userDetail($id)
    {
        $user = User::where('id', '=', $id)->first();
        if (!$user) {
            abort(404, 'User Not Found!');
        }
        return Inertia::render('UserDetail', ['user' => $user]);
    }

    public function userHistory($id)
    {
        $user = User::where('id', '=', $id)->first();
        if (!$user) {
            abort(404, 'User Not Found');
        }
        return Inertia::render('History');
    }

    public function schedule()
    {
        $user = Auth::user();
        $divisionPosition = DivisionPosition::where('name', '=', $user->getposition())->with(['position'])->first();
        $worktime = WorkTime::whereHas('division.division', function ($query) use ($user) {
            $query->where('name', '=', $user->getdivision());
        })->first();
        if (!$divisionPosition) {
            abort(409, 'Position not found!');
        }
        $months = Month::get();
        return Inertia::render('General/Schedule', ['worktime' => $worktime, 'months' => $months]);
    }

    public function reschedules()
    {
        return Inertia::render('General/Reschedule');
    }

    public function basics()
    {
        $templete = Templete::where('user_id', '=', Auth::user()->id)->whereHas('divisionworktime', function ($q) {
            $q->where('work', '=', 1);
        })->with(['templetetime.time'])->get();
        return Inertia::render('General/Basic', ['templets' => $templete]);
    }
}
