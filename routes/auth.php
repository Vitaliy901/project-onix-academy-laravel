<?php

use App\Http\Controllers\Web\LoginController;
use App\Http\Controllers\Web\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
	Route::controller(RegisterController::class)->group(function () {
		Route::get('/register', 'show')->name('register.show');
		Route::post('/register', 'store')->name('register.store');
	});

	Route::controller(LoginController::class)->group(function () {
		Route::get('/login', 'show')->name('login.show');
		Route::post('/login', 'login')->name('login');
	});
});
