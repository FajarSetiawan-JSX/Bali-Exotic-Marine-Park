<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CrudProfileController;
use App\Http\Controllers\api\OtpController;
use App\Http\Controllers\api\SuperAdmin\Master\AttachController;
use App\Http\Controllers\api\SuperAdmin\Master\DivisionController;
use App\Http\Controllers\api\SuperAdmin\Master\PositionController;
use App\Http\Controllers\api\SuperAdmin\Master\UsersController;
use App\Http\Controllers\api\SuperAdmin\Schedule\FullTimeController;
use App\Http\Controllers\api\SuperAdmin\Schedule\ShiftingController;
use App\Http\Controllers\api\SuperAdmin\Schedule\TimeController;
use App\Http\Controllers\api\SuperAdmin\Schedule\TypeScheduleController;
use App\Http\Controllers\api\SuperAdmin\SupervisorAssignController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/login', [AuthController::class, 'login']);
Route::post('/forget-password', [AuthController::class, 'forget']);
Route::patch('/change-password', [AuthController::class, 'changepas']);

Route::middleware(['auth:sanctum', 'activity'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::patch('/profile/update/{id}', [CrudProfileController::class, 'update']);
    Route::post('/profile/image', [CrudProfileController::class, 'image']);
    Route::get('/send', [OtpController::class, 'sendforchangepass']);
});

//Super Admin
Route::middleware(['auth:sanctum', 'activity', 'super_admin'])->prefix('priority-first')->group(function () {
    //Route USER
    Route::get('/users', [UsersController::class, 'index']);
    Route::post('/user', [UsersController::class, 'store']);
    Route::patch('/user/{id}', [UsersController::class, 'update']);
    Route::patch('/user/status/{id}', [UsersController::class, 'status']);

    Route::get('/divisions', [DivisionController::class, 'index']);
    Route::post('/division', [DivisionController::class, 'store']);
    Route::patch('/division/{id}', [DivisionController::class, 'update']);
    Route::delete('/division/{id}', [DivisionController::class, 'destroy']);

    Route::get('/positions/{division}', [PositionController::class, 'index']);
    Route::post('/position/{slug}', [PositionController::class, 'store']);
    Route::patch('/position/{id}', [PositionController::class, 'update']);
    Route::delete('/position/{id}', [PositionController::class, 'destroy']);

    Route::get('/Fulltime', [FullTimeController::class, 'index']);
    Route::post('/Fulltime', [FullTimeController::class, 'store']);
    Route::get('/Shifting', [ShiftingController::class, 'index']);
    Route::post('/Shifting', [ShiftingController::class, 'store']);
    Route::patch('/Time/{id}', [TimeController::class, 'update']);
    Route::delete('/Time/{id}', [TimeController::class, 'destroy']);

    Route::get('/supervisor', [SupervisorAssignController::class, 'index']);
    Route::post('/supervisor', [SupervisorAssignController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'supervisor'])->prefix('priority-second')->group(function () {});
