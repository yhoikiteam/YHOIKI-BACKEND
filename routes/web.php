<?php

use App\Http\Controllers\Auth\SPA\AuthController;
use App\Http\Controllers\Dashboard\Admin\UserController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', [HomeController::class,'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth');

Route::middleware('auth')->group(function (){
    Route::get('/home', [HomeController::class,'home'])->name('home');
});

Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
    Route::get('/users', [UserController::class, 'index']);

});

Route::middleware('auth', 'role:yhoiki', 'role:admin')->group(function () {
    Route::get('/dashboard/yhoiki', [DashboardController::class, 'yhoiki'])->name('dashboard.yhoiki');
});