<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function profile () {

		return view('profile', [
			'user' => auth()->user(),
		]);
	}

	public function logout () {
		Auth::logout();

		session()->invalidate();

		session()->regenerateToken();

		return redirect('/');
	}
}
