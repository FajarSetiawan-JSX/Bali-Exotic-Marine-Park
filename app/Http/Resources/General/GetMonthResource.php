<?php

namespace App\Http\Resources\General;

use App\Models\AssignSupervisor;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

use function PHPSTORM_META\map;

class GetMonthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $user = Auth::user();
        return [
            'id' => $this->id,
            'month' => $this->month,
            'date' => $this->date->map(function ($item) use ($user) {
                $date = Carbon::parse($item->date);
                $schedule = Schedule::where('date_id', '=', $item->id)->with(['templete.user', 'templete.divisionworktime.division', 'templete.templetetime.time', 'templete.divisionworktime.worktime', 'absen']);
                if ($user->getlevel() == 1) {
                    $schedule = $schedule->get();
                } elseif ($user->getlevel() == 2) {
                    $division = AssignSupervisor::where('user_id', '=', $user->id)->pluck('division_id');
                    $users = User::whereHas('divisionPosition.divisionPosition.division', function ($query) use ($division) {
                        $query->where('name', '=', $division);
                    })->pluck('id');
                    $schedule = $schedule->whereHas('templete.user', function ($q) use ($users) {
                        $q->whereIn('id', $users);
                    })->get();
                } else {
                    $division = $user->getdivision();
                    $users = User::whereHas('divisionPosition.divisionPosition.division', function ($query) use ($division) {
                        $query->where('name', '=', $division);
                    })->pluck('id');
                    $schedule = $schedule->whereHas('templete.user', function ($q) use ($users) {
                        $q->whereIn('id', $users);
                    })->get();
                }
                return [
                    'id' => $item->id,
                    'original' => $item->date,
                    'date' => $date->day,
                    'day' => $date->format('l'),
                    'schedule' => $schedule->map(function ($schedule) {
                        return [
                            'id' => $schedule->id,
                            'user' => $schedule->templete->user->name,
                            'templete' => $schedule->templete->name,
                            'work_time' => $schedule->templete->divisionworktime->worktime->name,
                            'work' => $schedule->templete->divisionworktime->work,
                            'start' => $schedule->templete->templetetime->time->start ?? null,
                            'end' => $schedule->templete->templetetime->time->end ?? null,
                            'division' => $schedule->templete->divisionworktime->division->name,
                            'absen' => $schedule->absen?->reason ?? null
                        ];
                    })
                ];
            }),
        ];
    }
}
