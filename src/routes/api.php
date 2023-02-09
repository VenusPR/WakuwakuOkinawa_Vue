<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AccountController;

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

// Route::apiResource('/banks', AccountController::class);


Route::get('/banks', [AccountController::class, 'allBanks']);
Route::get('/banks/{id}', [AccountController::class, 'oneBank']);
Route::put('/banks/{id}', [AccountController::class, 'updateBank']);
Route::post('/banks', [AccountController::class, 'createBank']);
Route::delete('/banks/{id}', [AccountController::class, 'destoryBank']);