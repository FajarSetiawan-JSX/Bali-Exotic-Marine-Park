<?php

namespace App\Http\Controllers;

use App\Models\ForgetPassword;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class RoutingController extends Controller
{
    public function home()
    {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }

    public function resetPassword($token, $email)
    {
        return Inertia::render('Auth/ResetPassword', ['email' => $email, 'token' => $token]);
    }

    public function dashboard()
    {
        return Inertia::render('Default/Dashboard');
    }
}
