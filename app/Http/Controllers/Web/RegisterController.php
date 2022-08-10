<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegisterUserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
	public function show()
    {
        return view('auth.register');
    }

    public function store(StoreRegisterUserRequest $request)
    {
        $user = User::create([
            'email' => $request->validated('email'),
            'password' => Hash::make($request->validated('password')),
        ]);
		
        Auth::login($user);

        return redirect()->route('user.profile');
    }
}
