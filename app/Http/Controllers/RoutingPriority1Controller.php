<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\DivisionPosition;
use App\Models\Level;
use App\Models\Position;
use App\Models\Time;
use App\Models\TypeSchedule;
use App\Models\Unit;
use App\Models\UnitDivision;
use App\Models\User;
use App\Models\WorkTime;

use function PHPSTORM_META\map;
use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Inertia\Inertia;

class RoutingPriority1Controller extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Admin/Dashboard');
    }
    public function user()
    {
        $divisions = Division::whereHas('level', function ($query) {
            $query->where('level', '!=', 1);
        })->get();
        $result = $divisions->map(function ($divisi) {
            return [
                'id' => $divisi['id'],
                'nama' => $divisi['name'],
                'positon' => $divisi->position()->get()->map(function ($position) {
                    return [
                        'id' => $position->id,
                        'header' => $position->position->name,
                        'name' => $position->name,
                    ];
                }),
                'user' => $divisi->getuser()
            ];
        });
        $users = User::query()->count();
        $online = User::where('last_activity', '>=', now()->subMinute(5))->count();
        return Inertia::render('Admin/User', ['divisions' => $result, 'users' => $users, 'online' => $online]);
    }
    public function division()
    {
        $divisi = Division::query();
        $totaldivisi = $divisi->get()->count();
        $count = [0, 0];
        $count[0] = UnitDivision::where('unit_id', '=', 1)->count();
        $count[1] = UnitDivision::where('unit_id', '=', 2)->count();
        $positions = DivisionPosition::whereHas('division.level', function ($query) {
            $query->where('level', '!=', 1);
        })->count();
        $worktime = WorkTime::get();
        $time = Time::count();
        $level = Level::where('level', '!=', 1)->get();
        $units = Unit::query()->get();
        return Inertia::render('Admin/Division', ['units' => $units, 'Positions' => $positions, 'WorkTime' => $worktime, 'time' => $time, 'Totaldivisi' => $totaldivisi, 'levels' => $level, 'count' => $count]);
    }

    public function position($slug)
    {
        $division = Division::where('slug', '=', $slug)->first();
        if (!$division) {
            abort(404, 'Division not found');
        }
        $position = Position::get();
        return Inertia::render('Admin/Positions', ['division' => $division, 'positions' => $position]);
    }

    public function spvassign()
    {


        return Inertia::render('Admin/Assign');
    }

    public function worktype()
    {
        $worktime = WorkTime::with(['division.division', 'time'])->get();
        $result = $worktime->map(function ($work) {
            return [
                'id' => $work->id,
                'name' => $work->name,
                'slug' => $work->slug,
                'division_work' => $work->division()->where('work', '=', 1)->get()->map(function ($divisi_work) {
                    return [
                        'id' => $divisi_work->id,
                        'work' => $divisi_work->work,
                        'division' => $divisi_work->division->name,
                    ];
                }),
            ];
        });
        return Inertia::render('Admin/Work', ['worktime' => $result]);
    }

    public function schedule()
    {
        return Inertia::render('Admin/Schedule');
    }
}
