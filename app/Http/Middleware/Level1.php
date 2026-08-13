<?php

namespace App\Http\Middleware;

use App\Models\Level;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Level1
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        if (!$user || $user->getlevel() !== 1) {
            return abort(403, 'You are not Super Admin, you dont have permission to access the page!');
        }
        return $next($request);
    }
}
