<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class RoutingPriority2Controller extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Supervisor/Dashboard');
    }
}
