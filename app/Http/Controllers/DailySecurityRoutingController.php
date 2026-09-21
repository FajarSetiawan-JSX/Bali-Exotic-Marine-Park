<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\BasicInformation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DailySecurityRoutingController extends Controller
{
    public function patrols()
    {
        $user = Auth::user();
        $areas = Area::count();
        $basics = BasicInformation::whereHas('templete.user', function ($query) use ($user) {
            $query->where('id', '=', $user->id);
        })->with(['date', 'templete.templetetime.time'])->orderBy('created_at', 'desc');
        $first = $basics->first();
        if ($first->date->date == now()->format('Y-m-d')) {
            $basic = $basics->first();
            $result = [
                [
                    'id' => $basic->id,
                    'date' => $basic->date->date,
                    'today' => $basic->date->date == now()->format('Y-m-d') ? TRUE : FALSE,
                    'work' => $basic->templete->name,
                    'start' => $basic->templete->templetetime->time->start,
                    'end' => $basic->templete->templetetime->time->end,
                    'totalarea' => $areas
                ],
            ];
        } else {
            $basics = $basics->take(2)->get();
            $result = $basics->map(function ($basic) use ($areas) {
                return [
                    'id' => $basic->id,
                    'date' => $basic->date->date,
                    'today' => $basic->date->date == now()->format('Y-m-d') ? TRUE : FALSE,
                    'work' => $basic->templete->name,
                    'start' => $basic->templete->templetetime->time->start,
                    'end' => $basic->templete->templetetime->time->end,
                    'totalarea' => $areas
                ];
            });
        }
        return Inertia::render('Specific/Security/Patrol', ['basics' => $result]);
    }

    public function patrol($basic)
    {
        $basic = BasicInformation::where('id', '=', $basic)->with(['date', 'templete'])->first();
        if (!$basic) {
            return Inertia::render('Error', ['status' => '404', 'message' => 'Basic Information not found!']);
        }
        if ($basic->templete->name != 'Shift 3' && $basic->date->date != now()->format('Y-m-d')) {
            return Inertia::render('Error', ['status' => '409', 'message' => 'Create Basic Information first!']);
        }
        $areas = Area::whereDoesntHave('patrol.patrol.basicinformation', function ($query) use ($basic) {
            $query->where('id', '=', $basic->id);
        })->with(['section.section.question.question'])->get();
        $results = $areas->map(function ($area) {
            return [
                'id' => $area->id,
                'name' => $area->name,
                'areaSection' => $area->section->filter(function ($s) {
                    return $s->section->name != 'Incident / Problem Report';
                })->map(function ($section) {
                    return [
                        'area_section_id' => $section->id,
                        'name' => $section->section->name,
                        'id' => $section->section->id,
                        'question' => $section->section->question->map(function ($question) {
                            return [
                                'id' => $question->id,
                                'question' => $question->question->question,
                                'type' => $question->question->type,
                                'option' => $question->question->option,
                                'part' => $question->question->part,
                                'trigger' => $question->question->trigger
                            ];
                        })->values()->toArray()
                    ];
                })->values()->toArray()
            ];
        });
        return Inertia::render('Specific/Security/PatrolCreate', ['areas' => $results]);
    }
}
