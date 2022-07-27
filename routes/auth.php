<?php

use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\RegisterUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
	Route::controller(RegisterUserController::class)->group(function () {
		Route::get('/register', 'create')->name('register.create');
		Route::post('/register', 'store')->name('register.store');
	});
	
	Route::controller(LoginUserController::class)->group(function () {
		Route::get('/login', 'create')->name('login');
		Route::post('/login', 'store')->name('login.store');
	});
});
