<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->route('user')->id === auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['bail', 'sometimes', 'string', 'max:255'],
            'email' => ['bail', 'sometimes', 'email:rfc,dns', 'max:255', Rule::unique('users')->ignore($this->user())],
            'password' => ['bail', 'sometimes', Password::min(6)->mixedCase()->numbers()->uncompromised()],
        ];
    }
}
