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

Route::get('/commit-changes', function () {
    return view('layouts.commit-changes');
})->name('commit.changes');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/change-password', [ProfileController::class, 'showChangePasswordForm'])->name('password.change');
Route::post('/change-password', [ProfileController::class, 'updatePassword'])->name('password.update');

Route::resource('zones', ZoneController::class);
Route::get('/zones', [ZoneController::class, 'index'])->name('zones.index');
Route::get('/newzone.php', [ZoneController::class, 'create'])->name('zones.create');
Route::get('/zones/{id}', [ZoneController::class, 'show'])->name('zones.show');

Route::post('/zones', [ZoneController::class, 'store'])->name('zones.store');



Route::get('/', [RegisterController::class, 'showRegisterForm']);
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


