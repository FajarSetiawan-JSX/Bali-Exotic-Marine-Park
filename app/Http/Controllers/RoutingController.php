<?php

namespace App\Http\Controllers;

use App\Models\Api;
use App\Models\Area;
use App\Models\BookingMethode;
use App\Models\Division;
use App\Models\DivisionPosition;
use App\Models\ForgetPassword;
use App\Models\Level;
use App\Models\Month;
use App\Models\Position;
use App\Models\Program;
use App\Models\Question;
use App\Models\Section;
use App\Models\Supplier;
use App\Models\Time;
use App\Models\Unit;
use App\Models\UnitDivision;
use App\Models\User;
use App\Models\Web;
use App\Models\WorkTime;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class RoutingController extends Controller
{
    public function home()
    {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function resetPassword($token, $email)
    {
        return Inertia::render('Auth/ResetPassword', ['email' => $email, 'token' => $token]);
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
                'position' => $divisi->position()->get()->map(function ($position) {
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
        return Inertia::render('User', ['divisions' => $result, 'users' => $users, 'online' => $online]);
    }

    public function userAccess($id)
    {
        $user = User::where('id', '=', $id)->first();
        if (!$user) {
            abort(404, 'User Not Found!');
        }
        return Inertia::render('UserAccess', ['user' => $user]);
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
        return Inertia::render('Division', ['units' => $units, 'Positions' => $positions, 'WorkTime' => $worktime, 'time' => $time, 'Totaldivisi' => $totaldivisi, 'levels' => $level, 'count' => $count]);
    }
    public function area()
    {
        $area = Area::count();
        return Inertia::render('Area', ['total' => $area]);
    }

    public function position($slug)
    {
        $division = Division::where('slug', '=', $slug)->first();
        if (!$division) {
            abort(404, 'Division not found');
        }
        $position = Position::get();
        return Inertia::render('Positions', ['division' => $division, 'positions' => $position]);
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
        return Inertia::render('Work', ['worktime' => $result]);
    }

    public function spvassign()
    {
        return Inertia::render('Assign');
    }

    public function web()
    {
        $pages = Web::count();
        return Inertia::render('Web', ['pages' => $pages]);
    }

    public function api()
    {
        return Inertia::render('Api');
    }

    public function scheduleCreate($user, $month)
    {
        $user = User::findOrFail($user);
        $month = Month::findOrFail($month);
        $users = User::whereHas('divisionPosition.divisionPosition.division', function ($query) use ($user) {
            $query->where('name', '=', $user->getdivision());
        })->get();
        return Inertia::render('Schedule/Create');
    }

    public function divisionpositionpage($slug)
    {
        $divisionposition = DivisionPosition::where('slug', '=', $slug)->first();
        if (!$divisionposition) {
            abort(404, 'Division Position not found!');
        }
        $webs = Web::where('scope', '!=', 'Super Admin')->get();
        return Inertia::render('DivisionPositionPage', ['divisionposition' => $divisionposition, 'webs' => $webs]);
    }

    public function divisionpositionapi($id)
    {
        $divisionposition = DivisionPosition::where('id', '=', $id)->first();
        if (!$divisionposition) {
            abort(404, 'Division Position not found!');
        }
        $apis = Api::where('scope', '!=', 'Super Admin')->with('methode')->get();
        return Inertia::render('DivisionPositionAPI', ['divisionposition' => $divisionposition, 'apis' => $apis]);
    }

    public function supplier()
    {
        $total = Supplier::count();
        return Inertia::render('Supplier', ['total' => $total]);
    }

    public function question()
    {
        $total = Question::count();
        $checklist = Question::where('type', '=', 'Checklist')->count();
        $text = $total - $checklist;
        $divisions = Division::all();
        $section = Section::all();
        return Inertia::render('Question', ['total' => $total, 'normal' => $checklist, 'incident' => $text, 'divisions' => $divisions, 'sections' => $section]);
    }

    public function methode()
    {
        $total = BookingMethode::count();
        return Inertia::render('Methode', ['total' => $total]);
    }

    public function contract()
    {
        return Inertia::render('Contract');
    }
    public function program()
    {
        $total = Program::count();
        return Inertia::render('Program', ['total' => $total]);
    }
    public function programavailable()
    {
        $programs = Program::all();
        return Inertia::render('ProgramBooking', ['programs' => $programs]);
    }

    public function pool(){
        return Inertia::render('Pool');
    }

    public function mamal(){
        return Inertia::render('Mamal');
    }
}
