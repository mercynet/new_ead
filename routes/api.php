<?php

use App\Http\Controllers\AuthController;
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
    ->group(function() {
        Route::post('login', 'login')->name('login');
        Route::post('register', 'register')->name('register');
    });

Route::middleware('auth:sanctum')->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    Route::name('mzrt.')->prefix('mzrt')->group(function(){
        Route::apiResources([
            'users' => \App\Http\Controllers\Mzrt\UserController::class,
        ]);
    });
});
