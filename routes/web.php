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
    Route::get('/contracts', [RoutingController::class, 'contract'])->name('super.admin.contract');
    Route::get('/areas', [RoutingController::class, 'area'])->name('super.admin.area');
    Route::get('/suppliers', [RoutingController::class, 'supplier'])->name('super.admin.supplier');
    Route::get('/methodes', [RoutingController::class, 'methode'])->name('super.admin.booking.methode');
    Route::get('/pools', [RoutingController::class, 'pool'])->name('super.admin.pool');
    Route::get('/division', [RoutingController::class, 'division'])->name('super.admin.division');
    Route::get('/spvassign', [RoutingController::class, 'spvassign'])->name('super.admin.attachment');
    Route::get('/work-type', [RoutingController::class, 'worktype'])->name('super.admin.work');
    Route::get('/questions', [RoutingController::class, 'question'])->name('super.admin.question');
    Route::get('/mammals', [RoutingController::class, 'mamal'])->name('super.admin.mamal');
    Route::get('/programs', [RoutingController::class, 'program'])->name('super.admin.program');
    Route::get('/programavailable', [RoutingController::class, 'programavailable'])->name('super.admin.program.category');
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
    Route::get('/user/{id}', [GeneralRoutingController::class, 'userDetail'])->name('user.detail');
    Route::get('/user/{id}/contract', [GeneralRoutingController::class, 'usercontract'])->name('user.contract');
    Route::get('/user/history/{id}', [GeneralRoutingController::class, 'userHistory'])->name('user.history');
});

Route::middleware(['auth', 'verified', 'specific_page'])->group(function () {
    Route::get('/basics', [GeneralRoutingController::class, 'basics'])->name('daily.basic');
    Route::get('/basic/{id}', [GeneralRoutingController::class, 'basic'])->name('daily.basic.detail');
    Route::get('/logistics', [DailySecurityRoutingController::class, 'logistics'])->name('logistics');
    Route::get('/deliveries', [DailySecurityRoutingController::class, 'deliveries'])->name('security.delivery');
    Route::get('/sales', [DailySecurityRoutingController::class, 'sales'])->name('sales');
    Route::get('/consumptions', [SpecificRoutingController::class, 'consumptions'])->name('specific.consumptions');
    Route::get('/healthchecks', [SpecificRoutingController::class, 'healthchecks'])->name('specific.healthchecks');
    Route::get('/waterqualities', [SpecificRoutingController::class, 'waterqualities'])->name('specific.waterqualities');
    Route::get('/poolareas', [SpecificRoutingController::class, 'poolareas'])->name('specific.poolareas');
    Route::get('/bookings', [SpecificRoutingController::class, 'bookings'])->name('specific.bookings');
    Route::get('/incidents', [SpecificRoutingController::class, 'incidents'])->name('incidents');
    Route::get('/patrols', [DailySecurityRoutingController::class, 'patrols'])->name('daily.patrols');
    Route::get('/patrol/{basic}', [DailySecurityRoutingController::class, 'patrol'])->name('daily.patrol.create');
    Route::get('/incident/{basic}', [SpecificRoutingController::class, 'incident'])->name('incident.create');
    Route::get('/reschedule/{id}', [SpecificRoutingController::class, 'reschedule'])->name('reschedule.create');
    Route::get('/visitor', [SpecificRoutingController::class, 'visitor'])->name('security.visitor');
    Route::get('/notifications', [SpecificRoutingController::class, 'notification'])->name('specific.notification');
    Route::get('/mammalreport', [SpecificRoutingController::class, 'mamalreport'])->name('specific.mammal.report');
    Route::get('/diets', [SpecificRoutingController::class, 'diets'])->name('specific.diet');
    Route::get('/orders', [SpecificRoutingController::class, 'order'])->name('specific.purchase.order');
    Route::get('/workorders', [SpecificRoutingController::class, 'workorders'])->name('specific.work.order');

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
