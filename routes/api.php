<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
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
	Route::apiResource('/posts', PostController::class);
});

Route::apiResource('/users', UserController::class);

Route::middleware('throttle:3,1')->group(function () {
	Route::post('/register', [AuthController::class, 'create']);
	Route::post('/login', [AuthController::class, 'login']);
});
