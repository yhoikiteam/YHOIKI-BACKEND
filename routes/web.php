<?php

use App\Http\Controllers\Auth\SPA\AuthController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\UsersDataControllers;

Route::get('/', function() {
    return Inertia::render('Login');
})->name('login');
Route::get('/dashboard', function() {
    return Inertia::render('Dashboard');
})->middleware('auth', 'role:admin')->name('dashboard');
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth');
Route::get('/userdata', [UsersDataControllers::class, 'index']);
