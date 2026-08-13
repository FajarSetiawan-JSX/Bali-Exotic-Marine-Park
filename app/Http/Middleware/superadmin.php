<?php

namespace App\Http\Middleware;

use App\Models\Level;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class superadmin
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
            return response()->json(['message' => 'You are not Super Admin, you dont have permission to access this end point'], 403);
        }
        return $next($request);
    }
}
