<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Mzrt\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('guest')
    ->controller(AuthController::class)
    ->group(function () {
        Route::post('login', 'login')->name('login');
        Route::post('register', 'register')->name('register');
    });

Route::middleware('auth:sanctum')->group(function () {
    Route::delete('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('check-token', [AuthController::class, 'checkToken'])->name('check-token');
    Route::name('mzrt.')->prefix('mzrt')->group(function () {
        Route::apiResources([
            'users' => UserController::class,
        ]);

        Route::name('users.')->prefix('users')->controller(UserController::class)->group(function () {
            Route::patch('enable/{user}', 'enable')->name('enable');
            Route::patch('disable/{user}', 'disable')->name('disable');
        });
    });
});
