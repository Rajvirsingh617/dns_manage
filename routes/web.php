<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ZoneController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

/* Route::get('/', function () {
    return view('welcome');
}); */

Route::get('/', [RegisterController::class, 'showRegisterForm']);
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/commit-changes', function () {
    return view('layouts.commit-changes');
})->name('commit.changes');

Route::middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Change Password
    Route::get('/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('password.update');

    // Zones routes
    Route::resource('zones', ZoneController::class)->except(['index', 'show']);
    Route::get('/zones', [ZoneController::class, 'index'])->name('zones.index');
    Route::get('/zones/{id}', [ZoneController::class, 'show'])->name('zones.show');
});
