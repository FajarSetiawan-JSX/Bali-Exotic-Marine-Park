<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class General
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();
        $routename = $request->route()->getName();
        $assemblypermission = $user->api()->filter(function ($item) use ($routename) {
            return $item->api->scope === 'General' && $item->api->route == $routename;
        });
        if ($assemblypermission->isEmpty()) {
            return response()->json(['message' => 'Access denied'], 403);
        }
        return $next($request);
    }
}
