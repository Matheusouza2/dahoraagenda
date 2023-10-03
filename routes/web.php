<?php

use App\Http\Controllers\BarberShopController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfissionalController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'index'])->name('hero_block');

Route::get('barbearia/{barberShopPhone}', [BarberShopController::class, 'consultByPhone']);

Route::post('login', [UserController::class, 'login'])->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');
Route::post('store', [UserController::class, 'store'])->name('store');

Route::prefix('entrar')->group(function () {
    Route::get('cliente', [LoginController::class, 'index'])->name('login.client');
    Route::get('salao', [LoginController::class, 'index'])->name('login.profissional');
});

Route::prefix('cliente')->middleware(['auth'])->group(function () {
    Route::get('inicio', [ClientController::class, 'index'])->name('home_client');

    Route::get('atendimentos', [ScheduleController::class, 'listScheduleUser'])->name('services_client');

    Route::get('agendamento/{barberShop?}', [ScheduleController::class, 'index'])->name('schedule_client');
});

Route::prefix('barbearias')->middleware(['auth'])->group(function () {
    Route::get('lista', [BarberShopController::class, 'index'])->name('barber_shop_list');

    Route::get('cadastrar', [BarberShopController::class, 'create']);
});

Route::prefix('barbeiro')->middleware(['auth'])->group(function () {
    Route::get('inicio', [ProfissionalController::class, 'index'])->name('home_barber');
});

Route::middleware(['auth'])->get('perfil/configuracoes', function () {
    return view('pages.settings');
})->name('settings');

Route::get('cadastrar', function () {
    return view('register');
})->name('register');

Route::get('offline', function () {
    return view('laravelpwa::offline');
});
