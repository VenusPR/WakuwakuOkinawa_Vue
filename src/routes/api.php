<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DebugController;
use App\Http\Controllers\Api\BanksController;
use App\Http\Controllers\Api\PrefecturesController;
use App\Http\Controllers\Api\ProfilesController;
use App\Http\Controllers\Api\ProfilesKidsController;
use App\Http\Controllers\Api\ProfilesSeniorsController;

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

Route::auto('/debug', DebugController::class); // デバッグ用

Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/user', [AuthController::class, 'getUser'])->middleware('auth:sanctum');

// Route::auto('/accounts', AccountController::class);
Route::apiResource('/banks', BanksController::class);
Route::post('/profiles/me/photo', [ProfilesController::class, 'updatePhoto']);
Route::apiResource('/profiles', ProfilesController::class);
Route::apiResource('/prefectures', PrefecturesController::class);

Route::get('/profiles/me/kids', [ProfilesKidsController::class, 'index']);
Route::post('/profiles/me/kids', [ProfilesKidsController::class, 'saveKids']);
Route::post('/profiles/me/kids/{id}/photo', [ProfilesKidsController::class, 'updatePhoto']);

Route::get('/profiles/me/seniors', [ProfilesSeniorsController::class, 'index']);
Route::post('/profiles/me/seniors', [ProfilesSeniorsController::class, 'saveSeniors']);
Route::post('/profiles/me/seniors/{id}/photo', [ProfilesSeniorsController::class, 'updatePhoto']);
