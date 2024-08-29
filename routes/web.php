<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoomController;

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

Route::get('/', [AuthController::class, 'showLogin']);
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/fetch_data', [DashboardController::class, 'fetchData']);
    Route::get('/get_chart_data', [DashboardController::class, 'getChartData']);

    Route::get('/ruangtengah', [RoomController::class, 'index'])->name('ruangtengah');
    Route::get('/api/get_mainroom_data', [RoomController::class, 'getMainRoomData'])->name('getMainRoomData');

    Route::get('/outdoor', [RoomController::class, 'outdoor'])->name('outdoor');
    Route::get('/get-outdoor-data', [RoomController::class, 'getOutdoorData'])->name('getOutdoorData');

    Route::get('/restroom', [RoomController::class, 'restroom'])->name('restroom');
    Route::get('/get-restroom-data', [RoomController::class, 'getRestroomData'])->name('getRestroomData');

    Route::get('/pantry', [RoomController::class, 'pantry'])->name('pantry');
    Route::get('/getPantryData', [RoomController::class, 'getPantryData'])->name('getPantryData');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
