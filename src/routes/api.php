<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DebugController;
use App\Http\Controllers\Api\BanksController;
use App\Http\Controllers\Api\PrefecturesController;
use App\Http\Controllers\Api\ProfilesController;
use App\Http\Controllers\Api\ProfilesKidsController;

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

Route::auto('/auth', AuthController::class);   // TODO: テスト用。後で変更
Route::auto('/debug', DebugController::class); // デバッグ用

// Route::auto('/accounts', AccountController::class);
Route::apiResource('/banks', BanksController::class);
Route::post('/profiles/me/photo', [ProfilesController::class, 'updatePhoto']);
Route::apiResource('/profiles', ProfilesController::class);
Route::apiResource('/prefectures', PrefecturesController::class);
Route::post('/profiles/me/kids/photo/{id}', [ProfilesKidsController::class, 'updatePhoto']);
Route::apiResource('/profiles/me/kids', ProfilesKidsController::class);
