<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use PhpParser\Node\Stmt\Return_;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [HomeController::class,'index']);
Route::get('/dashboard', function() {
    return Inertia::render('Dashboard');
});
