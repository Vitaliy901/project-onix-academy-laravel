<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
	public function profile (Request $request) {

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

	public function update (UpdateUserRequest $request) {
		return $request->validated();
	}
}
