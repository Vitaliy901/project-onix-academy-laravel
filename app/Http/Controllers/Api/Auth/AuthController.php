<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class AuthController extends Controller
{
	public function create(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users'],
            'password' => ['required', Password::min(8)->letters()->mixedCase()->numbers()],
		]);

		if ($validator->fails()) {
			return response()->json([
				'satatus' => false,
				'message' => 'validation error',
				'errors' => $validator->errors(),
			], 401);
		}
		
        $user = User::create([
			'name' => $validator->validated()['name'],
            'email' => $validator->validated()['email'],
            'password' => Hash::make($validator->validated()['password']),
        ]);
		
		return response()->json([
			'satatus' => true,
			'message' => 'User created successfully!',
			'api_token' => $user->createToken('API Token', ['publish'])->plainTextToken,
		], 401);
        
    }

	public function login(Request $request)
    {
		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
			'password' => 'required',
		]);

		if ($validator->fails()) {
			return response()->json([
				'satatus' => false,
				'message' => 'validation error',
				'errors' => $validator->errors(),
			], 401);
		}

		$credentials = $validator->validated();

		$user = User::where('email',$request->email)->first();

		if (Auth::attempt($credentials)) {
			return response()->json([
				'satatus' => true,
				'message' => 'User logged in successfully!',
				'api_token' => $user->createToken('API Token', ['publish'])->plainTextToken,
			]);
		};
	
		return response()->json([
			'satatus' => true,
			'message' => 'Email or password do not match our records.',
		], 401);
    }
}
