<?php

use App\Http\Controllers\Auth\SPA\AuthController;
use App\Http\Controllers\Auth\SPA\Dashboard\AdminController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UsersDataControllers;

Route::get('/', function() {
    return Inertia::render('Login');
})->name('login');

Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth');

Route::middleware('auth', 'role:admin')->group( function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/userdata', [UsersDataControllers::class, 'index']);
});