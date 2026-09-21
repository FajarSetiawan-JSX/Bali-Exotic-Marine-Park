<?php

use App\Http\Controllers\DailySecurityRoutingController;
use App\Http\Controllers\GeneralRoutingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoutingController;
use App\Http\Controllers\RoutingPriority1Controller;
use App\Http\Controllers\RoutingPriority2Controller;
use App\Http\Controllers\RoutingPriority3Controller;
use App\Http\Controllers\SpecificRoutingController;
use Illuminate\Support\Facades\Route;


Route::get('/', [RoutingController::class, 'home'])->name('home');

Route::middleware(['auth', 'verified', 'super_admin_page', 'throttle:web'])->group(function () {
    Route::get('/user', [RoutingController::class, 'user'])->name('super.admin.user');
    Route::get('/areas', [RoutingController::class, 'area'])->name('super.admin.area');
    Route::get('/suppliers', [RoutingController::class, 'supplier'])->name('super.admin.supplier');
    Route::get('/division', [RoutingController::class, 'division'])->name('super.admin.division');
    Route::get('/spvassign', [RoutingController::class, 'spvassign'])->name('super.admin.attachment');
    Route::get('/work-type', [RoutingController::class, 'worktype'])->name('super.admin.work');
    Route::get('/questions', [RoutingController::class, 'question'])->name('super.admin.question');
    Route::get('/web', [RoutingController::class, 'web'])->name('super.admin.permision.web');
    Route::get('/api', [RoutingController::class, 'api'])->name('super.admin.permission.api');
    Route::get('/division/{slug}', [RoutingController::class, 'position'])->name('super.admin.division.position');
    Route::get('/divisionposition/{slug}', [RoutingController::class, 'divisionpositionpage'])->name('super.admin.divisionposition.page');
    Route::get('/user/access/{id}', [RoutingController::class, 'userAccess'])->name('super.admin.user.access');
    Route::get('/divisionposition/api/{id}', [RoutingController::class, 'divisionpositionapi'])->name('super.admin.divisionposition.api');
});

Route::middleware(['auth', 'verified', 'general_page'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/dashboard', [GeneralRoutingController::class, 'dashboard'])->name('dashboard');
    Route::get('/schedule', [GeneralRoutingController::class, 'schedule'])->name('schedule');
    Route::get('/reschedules', [GeneralRoutingController::class, 'reschedules'])->name('reschedules');
    Route::get('/basics', [GeneralRoutingController::class, 'basics'])->name('daily.basic');
    Route::get('/user/{id}', [GeneralRoutingController::class, 'userDetail'])->name('user.detail');
    Route::get('/user/history/{id}', [GeneralRoutingController::class, 'userHistory'])->name('user.history');
});

Route::middleware(['auth', 'verified', 'specific_page'])->group(function () {
    Route::get('/patrols', [DailySecurityRoutingController::class, 'patrols'])->name('security.daily.patrols');
    Route::get('/patrol/{basic}', [DailySecurityRoutingController::class, 'patrol'])->name('security.daily.patrol.create');
    Route::get('/reschedule/{id}', [SpecificRoutingController::class, 'reschedule'])->name('reschedule.create');
    Route::get('/visitor', [SpecificRoutingController::class, 'visitor'])->name('security.visitor');

    Route::get('/schedule/{user}/{month}', [SpecificRoutingController::class, 'scheduleCreate'])->name('head.schedule.daily.create');
});

// Route::middleware(['auth', 'verified'])->group(function () {

//     Route::get('/schedule', [RoutingPriority3Controller::class, 'schedule'])->name('division.schedule');
//     Route::get('/reschedule', [RoutingPriority3Controller::class, 'reschedule'])->name('division.reschedule');
//     Route::get('/daily/patrol', [RoutingPriority3Controller::class, 'patrol'])->name('daily.patrol');
//     Route::get('/reschedule/{user}', [RoutingPriority3Controller::class, 'rescheduleCreate'])->name('division.reschedule.create');

//     Route::get('/schedule/{user}/{month}', [RoutingPriority3Controller::class, 'scheduleCreate'])->name('division.schedule.create');
// });

Route::middleware('auth')->group(function () {
    Route::get('/change-password', [ProfileController::class, 'changepassword'])->name('profile.changepassword');
    //Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    //Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
