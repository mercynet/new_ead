<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Mzrt\AddressController;
use App\Http\Controllers\Mzrt\CountryController;
use App\Http\Controllers\Mzrt\InstructorController;
use App\Http\Controllers\Mzrt\StudentController;
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
    Route::get('countries', CountryController::class)->name('countries');
    Route::name('mzrt.')->prefix('mzrt')->group(function () {
        Route::apiResources([
            'users' => UserController::class,
        ]);
        Route::name('users.')->prefix('users')->controller(UserController::class)->group(function () {
            Route::patch('enable/{user}', 'enable')->name('enable');
            Route::patch('disable/{user}', 'disable')->name('disable');
            Route::name('addresses.')
                ->prefix('addresses')
                ->controller(AddressController::class)
                ->group(function () {
                    Route::get('{user}', [AddressController::class, 'getByUser'])->name('by-user');
                    Route::post('{user}', [AddressController::class, 'store'])->name('store');
                    Route::put('{user}/{address}', [AddressController::class, 'update'])->name('update');
                });
            Route::name('instructor.')
                ->prefix('instructor')
                ->controller(InstructorController::class)
                ->group(function () {
                    Route::post('/', 'store')->name('store');
                    Route::put('/{user}', 'update')->name('update');
                });
            Route::name('student.')
                ->prefix('student')
                ->controller(StudentController::class)
                ->group(function () {
                    Route::post('/', 'store')->name('store');
                    Route::put('/{user}', 'update')->name('update');
                });
        });
    });
});
