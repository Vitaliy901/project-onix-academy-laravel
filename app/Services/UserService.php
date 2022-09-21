<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\ValidatedInput;

class UserService
{
    public function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function update(User $user, ValidatedInput $credentials)
    {
        !$credentials->only('new_password') ?:
            $credentials['password'] = Hash::make($credentials['new_password']);

        $user->update($credentials->except('new_pasword'));
    }
}
