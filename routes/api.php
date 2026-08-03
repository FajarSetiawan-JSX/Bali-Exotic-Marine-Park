<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\CrudProfileController;
use App\Http\Controllers\api\OtpController;
use App\Http\Controllers\api\SuperAdmin\Master\AttachController;
use App\Http\Controllers\api\SuperAdmin\Master\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/forget-password', [AuthController::class, 'forget']);
Route::patch('/change-password', [AuthController::class, 'changepas']);

Route::middleware(['auth:sanctum', 'activity'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::patch('/profile/update/{id}', [CrudProfileController::class, 'update']);
    Route::post('/profile/image', [CrudProfileController::class, 'image']);
    Route::get('/change-pass', [OtpController::class, 'sendforchangepass']);
});

//Super Admin
Route::middleware(['auth:sanctum', 'activity', 'super_admin'])->prefix('priority-first')->group(function () {
    //Route USER
    Route::get('/users', [UsersController::class, 'index']);

    Route::get('/attach', [AttachController::class, 'index']);
});

Route::middleware(['auth:sanctum', 'supervisor'])->prefix('priority-second')->group(function () {});
