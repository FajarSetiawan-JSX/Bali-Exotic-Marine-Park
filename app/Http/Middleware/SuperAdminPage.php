<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class SuperAdminPage
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        $routename = $request->route()->getName();
        $assemblypermission = $user->web()->filter(function ($item) use ($routename) {
            return $item->web->scope === 'Super Admin' && $item->web->route === $routename;
        });
        if ($assemblypermission->isEmpty()) {
            return Inertia::render('Error', ['status' => 409, 'message' => 'You dont have acces to this page!']);
        }
        return $next($request);
    }
}
