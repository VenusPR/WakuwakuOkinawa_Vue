<?php

use App\Http\Controllers\AppController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\DebugController;
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

Route::auto('/api/auth', AuthController::class);
Route::auto('/api/debug', DebugController::class);
Route::auto('/account', AccountController::class);


Route::get('/{any}', [AppController::class, 'index'])->where('any', '.*');
