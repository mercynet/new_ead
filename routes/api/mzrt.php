<?php

use App\Http\Controllers\API\V1\Mzrt\Courses\CourseController;
use App\Http\Controllers\API\V1\Mzrt\SettingController;
use App\Http\Controllers\API\V1\Mzrt\Users\AddressController;
use App\Http\Controllers\API\V1\Mzrt\Users\GroupUserController;
use App\Http\Controllers\API\V1\Mzrt\Users\InstructorController;
use App\Http\Controllers\API\V1\Mzrt\Users\RoleController;
use App\Http\Controllers\API\V1\Mzrt\Users\StudentController;
use App\Http\Controllers\API\V1\Mzrt\Users\UserController;
use App\Http\Controllers\API\V1\Mzrt\Users\UserGroupController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResources([
        'users' => UserController::class,
        'user-groups' => UserGroupController::class,
        'courses' => CourseController::class,
        'settings' => SettingController::class,
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
                Route::get('address/{postalCode}', 'addressByPostalCode')->name('address');
            });
        Route::name('instructor.')
            ->prefix('instructor')
            ->controller(InstructorController::class)
            ->group(function () {
                Route::post('/{user}', 'store')->name('store');
                Route::put('/{user}', 'update')->name('update');
            });
        Route::name('student.')
            ->prefix('student')
            ->controller(StudentController::class)
            ->group(function () {
                Route::post('/{user}', 'store')->name('store');
                Route::put('/{user}', 'update')->name('update');
                Route::patch('/increase-points/{user}', 'increasePoints')->name('increase-points');
                Route::patch('/decrease-points/{user}', 'decreasePoints')->name('decrease-points');
            });
    });

    Route::controller(RoleController::class)
        ->name('roles.')->prefix('roles')
        ->group(function () {
            Route::get('', 'index')->name('index');
        });
    Route::controller(GroupUserController::class)
        ->prefix('groups')
        ->name('groups.')
        ->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/all', 'all')->name('all');
        });

    /*
     * Settings Routes
     */
    Route::controller(SettingController::class)
        ->prefix('settings')->name('settings.')
        ->group(function () {
            Route::patch('activate/{user}', 'activate')->name('activate');
            Route::patch('inactivate/{user}', 'inactivate')->name('inactivate');
        });
});
