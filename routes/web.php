<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckSessionUser;
use App\Http\Middleware\RoleCheck;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\grafikController;
use App\Http\Controllers\riwayatController;
use App\Http\Controllers\manajementController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\dashboardController;
use Illuminate\Support\Facades\Session;

Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'registerForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/signin', [AuthController::class, 'firebaseSignIn'])->name('signin');

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware([CheckSessionUser::class])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'index'])->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/chart', [grafikController::class, 'index'])->name('chart');
    Route::get('/riwayat', [riwayatController::class, 'index'])->name('riwayat');
});

Route::middleware([CheckSessionUser::class, RoleCheck::class . ':admin'])->group(function () {
    Route::prefix('manajemen')->group(function () {
        Route::get('/', [manajementController::class, 'index'])->name('manajemen');
        Route::post('/settings', [manajementController::class, 'updateSensorSettings'])->name('sensor.settings.update');
        Route::get('/users', [manajementController::class, 'userManagement'])->name('user');
        Route::post('/users', [manajementController::class, 'store'])->name('user.store');
        Route::put('/users/{id}', [manajementController::class, 'update'])->name('user.update');
        Route::get('/users/{id}/delete', [manajementController::class, 'delete'])->name('user.delete');
        Route::post('/users/{id}/toggle-access', [manajementController::class, 'toggleAccess'])->name('user.toggle.access');
        Route::post('/users/{id}/toggle-active', [manajementController::class, 'toggleActive'])->name('user.toggle.active');
    });
});