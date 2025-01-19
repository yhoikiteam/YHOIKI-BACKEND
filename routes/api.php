<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/register',[RegisterController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/contact', [ContactController::class, 'index']);
    Route::post('/contact', [ContactController::class, 'store']);
    Route::get('/contact/{contact}', [ContactController::class, 'edit']);
    Route::put('/contact/{contact}', [ContactController::class, 'update']);
    Route::delete('/contact/{contact}', [ContactController::class, 'destroy']);
    Route::get('/contacts/deleted', [ContactController::class, 'showDelete']);
    Route::put('/contact/{id}/restore', [ContactController::class, 'restore']);
});
