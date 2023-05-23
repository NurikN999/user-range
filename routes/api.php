<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('users/{id}/increase-rank', [UserController::class, 'increaseRank']);
    Route::post('users/{id}/decrease-rank', [UserController::class, 'decreaseRank']);
    Route::get('users/rank', [UserController::class, 'getRank']);
    Route::post('users/cache', [UserController::class, 'cacheUsers']);
});
