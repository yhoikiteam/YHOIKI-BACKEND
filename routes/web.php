<?php

use App\Http\Controllers\Auth\SPA\AuthController;
use App\Http\Controllers\Auth\SPA\Dashboard\AdminController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UsersDataControllers;


Route::middleware('guest')->group(function () {
    Route::get('/', [HomeController::class,'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/userdata', [UsersDataControllers::class, 'index']);
});
