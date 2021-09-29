<?php

use App\Http\Controllers\AllAssetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\CommonTimeController;
use App\Http\Controllers\GraybeardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::prefix('/auth')->group(function () {
    Route::get('/register', [AuthController::class, 'register']);
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/common-times')->group(function () {
    Route::get('/', [CommonTimeController::class, 'index']);
    Route::get('/create', [CommonTimeController::class, 'create']);
    Route::post('/save-create', [CommonTimeController::class, 'store']);
    Route::get('/edit/{id}', [CommonTimeController::class, 'edit']);
    Route::post('/save-edit/{id}', [CommonTimeController::class, 'update']);
    Route::get('/{id}', [CommonTimeController::class, 'destroy']);
});

Route::prefix('/all-assets')->group(function () {
    Route::get('/', [AllAssetController::class, 'index']);
    Route::get('/create', [AllAssetController::class, 'create']);
    Route::post('/save-create', [AllAssetController::class, 'store']);
    Route::get('/edit/{id}', [AllAssetController::class, 'edit']);
    Route::post('/save-edit/{id}', [AllAssetController::class, 'update']);
    Route::get('/{id}', [AllAssetController::class, 'destroy']);
});

Route::prefix('/childrens')->group(function () {
    Route::get('/', [ChildrenController::class, 'index']);
    Route::get('/create', [ChildrenController::class, 'create']);
    Route::post('/save-create', [ChildrenController::class, 'store']);
    Route::get('/edit/{id}', [ChildrenController::class, 'edit']);
    Route::post('/save-edit/{id}', [ChildrenController::class, 'update']);
    Route::get('/{id}', [ChildrenController::class, 'destroy']);
});

Route::prefix('/graybeards')->group(function () {
    Route::get('/', [GraybeardController::class, 'index']);
    Route::get('/create', [GraybeardController::class, 'create']);
    Route::post('/save-create', [GraybeardController::class, 'store']);
    Route::get('/edit/{id}', [GraybeardController::class, 'edit']);
    Route::post('/save-edit/{id}', [GraybeardController::class, 'update']);
    Route::get('/{id}', [GraybeardController::class, 'destroy']);
});
