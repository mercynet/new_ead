<?php

use App\Http\Controllers\API\V1\Auth\AuthController;
use App\Http\Controllers\API\V1\Mzrt\CountryController;
use App\Http\Controllers\API\V1\Mzrt\Courses\CourseController;
use App\Http\Controllers\API\V1\Mzrt\Users\AddressController;
use App\Http\Controllers\API\V1\Mzrt\Users\InstructorController;
use App\Http\Controllers\API\V1\Mzrt\Users\StudentController;
use App\Http\Controllers\API\V1\Mzrt\Users\UserController;
use App\Http\Controllers\API\V1\Mzrt\Users\UserGroupController;
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

Route::middleware('auth:sanctum')->group(function () {
    Route::name('mzrt.')->prefix('mzrt')->group(function () {

    });
});
