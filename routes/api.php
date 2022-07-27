<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\PostController;

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
Route::apiResource('/posts',PostController::class)->middleware('auth:sanctum');

Route::middleware('throttle:3,1')->group(function () {
	Route::post('/register', [AuthController::class, 'create']);
	Route::post('/login', [AuthController::class, 'login']);
});