<?php

use App\Http\Controllers\BarberShopController;
use App\Http\Controllers\ScheduleCloseController;
use App\Http\Controllers\ScheduleConfigController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('barber')->middleware(['auth:sanctum'])->group(function () {
    Route::post('store', [BarberShopController::class, 'store']);
});

Route::prefix('schedule')->middleware(['auth:sanctum'])->group(function () {
    Route::post('store', [ScheduleController::class, 'store']);
    Route::get('consult', [ScheduleController::class, 'consultHour']);
    Route::get('list', [ScheduleController::class, 'list']);
});

Route::prefix('schedule_close')->middleware(['auth:sanctum'])->group(function () {
    Route::get('consult/{barber}', [ScheduleCloseController::class, 'consultClosedBarber']);
});
