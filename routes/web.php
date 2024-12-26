<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\DashboardController;


/* Route::get('/', function () {
    return view('welcome');
}); */



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::resource('zones', ZoneController::class);
Route::get('/zones', [ZoneController::class, 'index'])->name('zones.index');



Route::get('/', [RegisterController::class, 'showRegisterForm']);
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

