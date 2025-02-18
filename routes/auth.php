<?php

use App\Http\Controllers\Auth\EmailVerifyController;
use App\Http\Controllers\Auth\SPA\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])
    // ->name('register');

    // Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthController::class, 'loginView'])
    ->name('login');

    Route::post('login', [AuthController::class, 'login']);

    // Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
    // ->name('password.request');

    // Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
    // ->name('password.email');

    // Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
    // ->name('password.reset');

    // Route::post('reset-password', [NewPasswordController::class, 'store'])
    // ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/verify-email', [EmailVerifyController::class,'index'])
        ->name('verification.notice');

    // Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    // ->name('password.confirm');

    // Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');
});