<?php

namespace App\Http\Middleware;

use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        //ambil route dashboard dinamis sesuai divisi
        $user = Auth::user();
        $dashboardroute = null;
        $level = null;
        $division = null;
        $position = null;

        if ($user) {
            $level = $user->getlevel();
            $division = $user->getdivision();
            $position = $user->getposition();
            $dashboardroute = match ($user->getlevel()) {
                1 => 'super.admin.dashboard',
                2 => 'supervisor.dashboard',
                3 => '',
                null => 'default.dashboard',
            };
        }
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'level' => $level,
                'division' => $division,
                'position' => $position,
                //shere route melalui inertia
                'dashboard' => $dashboardroute
            ],
        ];
    }
}
