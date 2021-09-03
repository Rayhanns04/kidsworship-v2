<?php

use App\Http\Controllers\Api\CommonTimeApiController;
use App\Http\Controllers\ApiGetImageController;
use App\Http\Controllers\ChildrenAuthApiController;
use App\Http\Controllers\GraybeardApiController;
use App\Http\Controllers\GraybeardController;
use App\Http\Controllers\PrayerController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Protected routes
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/all-childrens', [ChildrenAuthApiController::class, 'index']);

    Route::prefix('/childrens')->group(function () {
        Route::post('/', [GraybeardController::class, 'index']);
        Route::post('/logout', [GraybeardController::class, 'logout']);
    });

    Route::prefix('/prayers')->group(function () {
        Route::get('/', [PrayerController::class, 'index']);
        Route::post('/store', [PrayerController::class, 'store']);
        Route::get('/{id}', [PrayerController::class, 'getPrayer']);
    });

    Route::prefix('/parents')->group(function () {
        Route::get('/childrens/{id}', [GraybeardApiController::class, 'eachChildren']);
        Route::get('/{id}', [GraybeardApiController::class, 'index']);
        Route::post('/logout', [ChildrenAuthApiController::class, 'logout']);
    });

    Route::get('/common-time', [CommonTimeApiController::class, 'index']);
});

// Testing route
Route::get('/without', [PrayerController::class, 'index']);

// Public routes
Route::prefix('/childrens')->group(function () {
    Route::post('/register', [ChildrenAuthApiController::class, 'register']);
    Route::post('/login', [ChildrenAuthApiController::class, 'login']);
    Route::get('/check/{id}', [ChildrenAuthApiController::class, 'checkHaveOrNot']);
});

Route::prefix('/parents')->group(function () {
    Route::post('/register', [GraybeardController::class, 'register']);
    Route::post('/login', [GraybeardController::class, 'login']);
});

Route::get('/image/{path}/{name}', [ApiGetImageController::class, 'index']);
