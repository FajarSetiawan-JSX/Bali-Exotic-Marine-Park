<?php

namespace App\Http\Middleware;

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
        if ($user) {
            $dashboardroute = match ($user->division->level->level) {
                1 => 'super.admin.dashboard',
                2 => 'supervisor.dashboard',
                3 => '',
                'default' => 'default.dashboard',
            };
        }
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
                'me' => $user,
                //shere route melalui inertia
                'dashboard' => $dashboardroute
            ],
        ];
    }
}
