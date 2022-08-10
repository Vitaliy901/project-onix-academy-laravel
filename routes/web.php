<?php

use App\Http\Controllers\Web\LangController;
use App\Http\Controllers\Web\PostController;
use App\Http\Controllers\Web\UserController;
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

Route::middleware('auth')->group(function () {
	Route::get('/profile', [UserController::class, 'profile'])
		->name('user.profile');
	Route::get('/profile/logout', [UserController::class, 'logout'])
		->name('user.loguot');
	Route::post('/profile/update', [UserController::class, 'update'])
		->name('user.update');
});

Route::resource('/posts', PostController::class);

Route::get('lang/{lang}', LangController::class)->name('lang');

Route::get('/', function () {
	return view('welcome');
})->name('home');
