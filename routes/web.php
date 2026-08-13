<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\RoutingPriority1Controller;
use App\Http\Controllers\RoutingPriority2Controller;
use Illuminate\Support\Facades\Route;


Route::get('/', [RoutingController::class, 'home'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/guest/dashboard', [RoutingController::class, 'dashboard'])->name('default.dashboard');
});

//SUPER ADMIN
Route::middleware(['auth', 'verified', 'user_level_1'])->prefix('superadmin')->group(function () {
    Route::get('/dashboard', [RoutingPriority1Controller::class, 'dashboard'])->name('super.admin.dashboard');
    Route::get('/user', [RoutingPriority1Controller::class, 'user'])->name('super.admin.user');

    //
    Route::get('/division', [RoutingPriority1Controller::class, 'division'])->name('super.admin.division');
    Route::get('/permission', [RoutingPriority1Controller::class, 'permission'])->name('super.admin.permission');
    Route::get('/attachment', [RoutingPriority1Controller::class, 'spvassign'])->name('super.admin.attachment');
    
    Route::get('/work-type', [RoutingPriority1Controller::class, 'worktype'])->name('super.admin.work');
    Route::get('/schedule', [RoutingPriority1Controller::class, 'schedule'])->name('super.admin.schedule');

    Route::get('/division/{slug}', [RoutingPriority1Controller::class, 'position'])->name('super.admin.division.position');
});
//SUPERVISOR
Route::middleware(['auth', 'verified'])->prefix('priority-second')->group(function () {
    Route::get('/dashboard', [RoutingPriority2Controller::class, 'dashboard'])->name('supervisor.dashboard');
    Route::get('/report', [RoutingPriority2Controller::class, 'dashboard'])->name('supervisor.report');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/change-password', [ProfileController::class, 'changepassword'])->name('profile.changepassword');
    //Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
