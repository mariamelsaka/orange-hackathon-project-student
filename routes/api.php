<?php

namespace App\Http\Controllers\Api;
namespace App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\StudntController;
use GuzzleHttp\Psr7\Uri;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});


Route::group(['prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register_student', [AuthController::class, 'register_student']);

    Route::post('view_course', [CourseController::class, 'view_course']);
    Route::post('register_course', [CourseController::class, 'register_course']);




    Route::group(['middleware' => 'auth:sanctum'], function() {
        Route::get('logout', [AuthController::class, 'logout']);
    });
});

