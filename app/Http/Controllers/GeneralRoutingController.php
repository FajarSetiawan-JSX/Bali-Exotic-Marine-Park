<?php

namespace App\Http\Controllers;

use App\Models\BasicInformation;
use App\Models\Booking;
use App\Models\BookingMethode;
use App\Models\Contract;
use App\Models\Division;
use App\Models\DivisionPosition;
use App\Models\Level;
use App\Models\Mamals;
use App\Models\Month;
use App\Models\Notification;
use App\Models\Pool;
use App\Models\Position;
use App\Models\Program;
use App\Models\ProgramCategory;
use App\Models\Supplier;
use App\Models\Templete;
use App\Models\User;
use App\Models\Visitor;
use App\Models\WorkTime;
use Carbon\Carbon;
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
        $iam = Auth::user();
        $notifications = Notification::orderBy('created_at', 'desc')->with(['user.user', 'user.divisionPosition'])->take(5)->get();
        $notifications = $notifications->filter(function ($item) use ($iam) {
            $position = DivisionPosition::where('name', '=', $item->user->user->getposition())->first();
            if ($item->user->user->getlevel() == 3 && $position->position->name == 'Head') {
                return $item->user->divisionPosition->division->name == $iam->getdivision();
            }
            return $item;
        })->map(function ($n) {
            return [
                'id' => $n->id,
                'name' => $n->user->user->name,
                'avatar' => $n->user->user->profile,
                'position' => $n->user->user->getposition(),
                'division' => $n->user->user->getdivision(),
                'notification' => $n->notification,
                'img' => $n->img,
                'date' => $n->created_at
            ];
        });
        return Inertia::render('Dashboard', ['datalevel' => $datalevel, 'label' => $label, 'data' => $data, 'user' => $user, 'notifications' => $notifications]);
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
        $total = BasicInformation::whereHas('date', function ($b) {
            $b->where('date', '=', now()->format('d-m-Y'));
        })->count();
        return Inertia::render('General/Basic', ['templets' => $templete, 'total' => $total]);
    }

    public function basic($id)
    {
        $basic = BasicInformation::where('id', '=', $id)->first();
        if (!$basic) {
            abort(404, 'Basic Information not found!');
        }
        $suppliers = Supplier::all();
        $bookingmethodes = BookingMethode::all();
        $mamals = Mamals::orderBy('name', 'asc')->get();
        $pools = Pool::all();
        $programcategpries = ProgramCategory::with(['program'])->get();
        $programs = Program::all();
        $result = [
            'id' => $basic->id,
            'done' => $basic->done,
            'name' => $basic->templete->user->name,
            'date' => $basic->date->date,
            'division' => $basic->division->name,
            'time' => $basic->templete->templetetime->time->name,
            'start' => $basic->templete->templetetime->time->start,
            'end' => $basic->templete->templetetime->time->end
        ];
        return Inertia::render('Specific/BasicDetail', ['basic' => $result, 'bookingmethodes' => $bookingmethodes, 'programcategories' => $programcategpries, 'suppliers' => $suppliers, 'mamals' => $mamals, 'pools' => $pools, 'programs' => $programs]);
    }

    public function usercontract($id)
    {
        $user = User::where('id', '=', $id)->with(['contract'])->first();
        if (!$user) {
            abort(404, 'User Not Found!');
        }
        $last = $user->contract()->latest()->with('contract')->first();
        $expired = null;
        if ($last) {
            $duration = (int) $last->contract->duration;
            $expired = Carbon::parse($last->in)->addMonths($duration)->toDateString();
        }
        $result = [
            'id' => $user->id,
            'name' => $user->name,
            'division' => $user->getdivision(),
            'position' => $user->getposition(),
            'nik' => decrypt($user->nik),
            'profile' => $user->avatar,
            'bank' => $user->rekening ? decrypt($user->rekening) : null,
            'health' => $user->bpjs_kes ? decrypt($user->bpjs_kes) : null,
            'work' => $user->bpjs_tk ? decrypt($user->bpjs_tk) : null,
            'contract' => $user->contract()->count(),
            'join' => $user->created_at,
            'last' => $last ? [
                'id' => $last->id,
                'contract' => $last->contract->name,
                'duration' => $last->contract->duration,
                'in' => $last->in,
                'expired' => $expired,
                'status' => $expired > now() ? true : false
            ] : null
        ];
        $contract = Contract::all();
        return Inertia::render('General/Contract', ['user' => $result, 'contracts' => $contract]);
    }
}
