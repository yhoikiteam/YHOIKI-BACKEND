<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use PhpParser\Node\Stmt\Return_;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UsersDataControllers;

Route::get('/', function() {
    return Inertia::render ('Login');
});
Route::get('/dashboard', function() {
    return Inertia::render('Dashboard');
});

Route::get('/userdata', [UsersDataControllers::class, 'index']);
