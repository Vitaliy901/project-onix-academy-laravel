<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
	public function create()
    {
        return view('auth.login');
    }

	public function store(Request $request)
    {
        $credentials = $request->validate([
			'email' => 'required|email',
			'password' => 'required',
		]);

		if (Auth::attempt($credentials, $request->get('remember'))) {
			$request->session()->regenerate();

			return redirect()->route('user.profile');
		};

		return back()->withErrors([
			'email' => 'Email or password do not match our records.',
		])->onlyInput('email');
    }
}
