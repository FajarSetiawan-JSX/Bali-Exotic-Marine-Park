<?php

namespace App\Http\Middleware;

use App\Models\ForgetPassword;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class CekTokenPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $key = ForgetPassword::where('email', '=', $request->route('email'))->latest()->first();
        if (!$key) {
            return abort(404, 'Email not found.');
        }
        if (!Hash::check($request->route('token'), $key->token)) {
            return abort(404, 'Token invalid.');
        }
        if (now() < $key->created_at->addMinutes(5) && $key->used == null) {
            return $next($request);
        } else {
            return abort(404, 'Token has expired.');
        }
    }
}
