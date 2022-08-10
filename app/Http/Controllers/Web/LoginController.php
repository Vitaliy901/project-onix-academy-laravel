<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
	public function show()
    {
        return view('auth.login');
    }

	public function login(Request $request)
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
