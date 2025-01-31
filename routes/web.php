<?php

use App\Http\Controllers\Auth\SPA\AuthController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/', [HomeController::class,'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware('auth', 'role:user')->group(function () {
    Route::get('/dashboard/user', [DashboardController::class, 'user'])->name('dashboard.user');
});

Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
});
