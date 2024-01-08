<?php

use App\Http\Controllers\API\V1\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')
    ->controller(AuthController::class)
    ->group(function () {
        Route::post('login', 'login')->name('login');
        Route::post('register', 'register')->name('register');
    });

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', [AuthController::class, 'me'])->name('me');
    Route::delete('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('check-token', [AuthController::class, 'checkToken'])->name('check-token');
});
