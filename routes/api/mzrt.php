<?php

use App\Http\Controllers\API\V1\Mzrt\Courses\CourseController;
use App\Http\Controllers\API\V1\Mzrt\SettingController;
use App\Http\Controllers\API\V1\Mzrt\Users\AddressController;
use App\Http\Controllers\API\V1\Mzrt\Users\GroupController;
use App\Http\Controllers\API\V1\Mzrt\Users\InstructorController;
use App\Http\Controllers\API\V1\Mzrt\Users\PhoneNumberController;
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
                Route::get('{postalCode}', 'addressByPostalCode')->name('address');
                Route::get('{user}', 'getByUser')->name('by-user');
                Route::post('{user}', 'store')->name('store');
                Route::put('{user}/{address}', 'update')->name('update');
            });
        Route::name('phone-numbers.')
            ->prefix('phone-numbers')
            ->controller(PhoneNumberController::class)
            ->group(function () {
                Route::get('{user}', 'index')->name('index');
                Route::post('{user}', 'store')->name('store');
                Route::put('{phoneNumber}', 'update')->name('update');
                Route::delete('{phoneNumber}', 'destroy')->name('destroy');
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
    Route::controller(GroupController::class)
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
