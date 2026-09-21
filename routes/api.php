<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CrudProfileController;
use App\Http\Controllers\api\General\AbsenController;
use App\Http\Controllers\api\General\DailyController;
use App\Http\Controllers\api\General\GeneralController;
use App\Http\Controllers\api\OtpController;
use App\Http\Controllers\api\Specific\ScheduleController;
use App\Http\Controllers\api\Specific\SecuirtyDailyController;
use App\Http\Controllers\api\Specific\SecurityVisitorController;
use App\Http\Controllers\api\SuperAdmin\AccessAPIController;
use App\Http\Controllers\api\SuperAdmin\AccessWebController;
use App\Http\Controllers\api\SuperAdmin\UsersController;
use App\Http\Controllers\api\SuperAdmin\ApiController;
use App\Http\Controllers\api\SuperAdmin\AreaController;
use App\Http\Controllers\api\SuperAdmin\Master\AttachController;
use App\Http\Controllers\api\SuperAdmin\DivisionController;
use App\Http\Controllers\api\SuperAdmin\PositionController;
use App\Http\Controllers\api\SuperAdmin\Schedule\DateController;
use App\Http\Controllers\api\SuperAdmin\FullTimeController;
use App\Http\Controllers\api\SuperAdmin\QuestionController;
use App\Http\Controllers\api\SuperAdmin\Schedule\MonthController;
use App\Http\Controllers\api\SuperAdmin\ShiftingController;
use App\Http\Controllers\api\SuperAdmin\TimeController;
use App\Http\Controllers\api\SuperAdmin\Schedule\TypeScheduleController;
use App\Http\Controllers\api\SuperAdmin\SupervisorAssignController;
use App\Http\Controllers\api\SuperAdmin\SupplierController;
use App\Http\Controllers\api\SuperAdmin\WebController;
use App\Http\Controllers\api\Supervisor\UserSupervisorController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/forget-password', [AuthController::class, 'forget']);
Route::patch('/change-password', [AuthController::class, 'changepas']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/months', [MonthController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'activity'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::patch('/profile/update/{id}', [CrudProfileController::class, 'update']);
    Route::post('/profile/image', [CrudProfileController::class, 'image']);
    Route::get('/send', [OtpController::class, 'sendforchangepass']);
});

//Super Admin
Route::middleware(['auth:sanctum', 'activity', 'super_admin'])->group(function () {
    Route::get('/webs', [WebController::class, 'index'])->name('super.admin.web.index');
    Route::post('/web', [WebController::class, 'store']);
    Route::patch('/web/{id}', [WebController::class, 'update']);
    Route::delete('/web/{id}', [WebController::class, 'destroy']);

    Route::get('/apis', [ApiController::class, 'index'])->name('super.admin.api.index');
    Route::post('/api', [ApiController::class, 'store']);
    Route::patch('/api/{id}', [ApiController::class, 'update']);
    Route::delete('/api/{id}', [ApiController::class, 'destroy']);

    Route::post('/user', [UsersController::class, 'store'])->name('super.admin.user.store');
    Route::patch('/user/{id}', [UsersController::class, 'update'])->name('super.admin.user.update');
    Route::delete('/user/{id}', [UsersController::class, 'destroy'])->name('super.admin.user.delete');
    Route::patch('/user/status/{id}', [UsersController::class, 'status'])->name('super.admin.user.status');

    Route::get('/divisions', [DivisionController::class, 'index'])->name('super.admin.division.index');
    Route::post('/division', [DivisionController::class, 'store'])->name('super.admin.division.store');
    Route::patch('/division/{id}', [DivisionController::class, 'update'])->name('super.admin.division.update');
    Route::delete('/division/{id}', [DivisionController::class, 'destroy'])->name('super.admin.division.delete');

    Route::get('/areas', [AreaController::class, 'index'])->name('super.admin.area.index');
    Route::post('/area', [AreaController::class, 'store'])->name('super.admin.area.store');
    Route::patch('/area/{id}', [AreaController::class, 'update'])->name('super.admin.area.update');
    Route::delete('/area/{id}', [AreaController::class, 'destroy'])->name('super.admin.area.delete');

    Route::get('/positions/{division}', [PositionController::class, 'index'])->name('super.admin.position.index');
    Route::post('/position/{slug}', [PositionController::class, 'store'])->name('super.admin.position.store');
    Route::patch('/position/{id}', [PositionController::class, 'update'])->name('super.admin.position.update');
    Route::delete('/position/{id}', [PositionController::class, 'destroy'])->name('super.admin.position.delete');

    Route::get('/supervisor', [SupervisorAssignController::class, 'index'])->name('super.admin.supervisor.index');
    Route::post('/supervisor', [SupervisorAssignController::class, 'store'])->name('super.admin.supervisor.store');
    Route::delete('/supervisor/{id}', [SupervisorAssignController::class, 'destroy'])->name('super.admin.supervisor.delete');

    Route::get('/fulltime', [FullTimeController::class, 'index'])->name('super.admin.fulltime.index');
    Route::post('/fulltime', [FullTimeController::class, 'store'])->name('super.admin.fulltime.store');
    Route::get('/shifting', [ShiftingController::class, 'index'])->name('super.admin.shifting.index');
    Route::post('/shifting', [ShiftingController::class, 'store'])->name('super.admin.shifting.store');
    Route::patch('/time/{id}', [TimeController::class, 'update'])->name('super.admin.time.patch');
    Route::delete('/time/{id}', [TimeController::class, 'destroy'])->name('super.admin.time.delete');

    Route::get('/accesswebs/{id}', [AccessWebController::class, 'index'])->name('super.admin.accessweb.index');
    Route::post('/accessweb/{id}', [AccessWebController::class, 'store'])->name('super.admin.accessweb.store');
    Route::patch('/accessweb/{id}', [AccessWebController::class, 'update'])->name('super.admin.accessweb.update');
    Route::delete('/accessweb/{id}', [AccessWebController::class, 'destroy'])->name('super.admin.accessweb.delete');

    Route::get('/accessapis/{id}', [AccessAPIController::class, 'index'])->name('super.admin.accessapi.index');
    Route::post('/accessapi/{id}', [AccessAPIController::class, 'store'])->name('super.admin.accessapi.store');
    Route::patch('/accessapi/{id}', [AccessAPIController::class, 'update'])->name('super.admin.accessapi.update');
    Route::delete('/accessapi/{id}', [AccessAPIController::class, 'destroy'])->name('super.admin.accessapi.delete');

    Route::get('/supplies', [SupplierController::class, 'index'])->name('super.admin.supplier.index');
    Route::post('/supplier', [SupplierController::class, 'store'])->name('super.admin.supplier.store');
    Route::patch('/supplier/{id}', [SupplierController::class, 'update'])->name('super.admin.supplier.update');
    Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('super.admin.supplier.delete');

    Route::get('/questions', [QuestionController::class, 'index'])->name('super.admin.question.index');
    Route::post('/question', [QuestionController::class, 'store'])->name('super.admin.question.store');
    Route::patch('/question/{id}', [QuestionController::class, 'update'])->name('super.admin.question.update');
    Route::delete('/question/{id}', [QuestionController::class, 'destroy'])->name('super.admin.question.delete');
});

Route::middleware(['auth:sanctum', 'activity', 'general'])->group(function () {
    Route::get('/users', [UsersController::class, 'index'])->name('user.index');
    Route::post('/months', [MonthController::class, 'index'])->name('general.months.schedule');
    Route::get('/absen', [AbsenController::class, 'index'])->name('general.absen.index');
    Route::get('/user/{id}', [UsersController::class, 'show'])->name('user.show');
    Route::get('/reschedules', [ScheduleController::class, 'index'])->name('general.reschedules');
    Route::get('/basics', [DailyController::class, 'index'])->name('general.basics.information.daily');
    Route::get('/incidents', [DailyController::class, 'index'])->name('general.incident.report');
});

Route::middleware(['auth:sanctum', 'activity', 'specific'])->group(function () {
    Route::post('/month', [MonthController::class, 'store'])->name('specific.months.generate');
    Route::delete('/month/{id}', [MonthController::class, 'destroy'])->name('specific.months.delete');
    Route::post('/absen', [AbsenController::class, 'store'])->name('specific.absen.store');
    Route::patch('/absen/{id}', [AbsenController::class, 'update'])->name('specific.absen.update');
    Route::delete('/absen/{id}', [AbsenController::class, 'destroy'])->name('specific.absen.delete');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('specific.schedule.create');
    Route::post('/reschedule', [ScheduleController::class, 'store'])->name('specific.reschedule.create');
    Route::post('/schedule/download', [ScheduleController::class, 'download'])->name('specific.schedule.download');
    //secuirty
    Route::post('/basic', [DailyController::class, 'store'])->name('specific.basics.information.daily.create');
    Route::get('/patrols', [SecuirtyDailyController::class, 'index'])->name('specific.secuirty.patrols');
    Route::post('/patrol', [SecuirtyDailyController::class, 'store'])->name('specific.secuirty.patrol.create');
    Route::post('/incident', [DailyController::class, 'index'])->name('specific.incident.report.create');

    Route::get('/visitors', [SecurityVisitorController::class, 'index'])->name('specific.security.visitor.index');
    Route::post('/visitor', [SecurityVisitorController::class, 'store'])->name('specific.security.visitor.store');
    Route::patch('/visitor/{id}', [SecurityVisitorController::class, 'update'])->name('specific.security.visitor.update');
    Route::delete('/visitor/{id}', [SecurityVisitorController::class, 'destroy'])->name('specific.security.visitor.delete');
});

Route::middleware(['auth:sanctum', 'activity', 'super_admin'])->prefix('priority-first')->group(function () {

    Route::get('/dates', [DateController::class, 'index']);
    //Route::post('/date', [DateController::class, 'store']);
    //Route::patch('/date/{id}', [DateController::class, 'update']);
    //Route::delete('/date/{id}', [DateController::class, 'destroy']);

    //Route::patch('/date/{id}', [DateController::class, 'update']);
    //Route::delete('/date/{id}', [DateController::class, 'destroy']);


});

Route::middleware(['auth:sanctum', 'supervisor'])->prefix('priority-second')->group(function () {
    Route::get('/users', [UserSupervisorController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'division'])->prefix('priority-third')->group(function () {});
