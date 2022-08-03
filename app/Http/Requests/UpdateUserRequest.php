<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateUserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
			'email' => ['bail','required','email:rfc,dns',Rule::unique('users')->ignore($this->user())],
			'password' => ['bail','confirmed', Password::min(6)->mixedCase()->numbers()->uncompromised()],
			'password_confirmation' => 'required_with:password',
        ];
    }

	public function messages()
	{
		return [
			'name.required' => 'A :attribute is required!',
			'email.required' => 'A :attribute is required!',
			'email.unique' => 'This :attribute is already exists!',
			'password.confirmed' => 'The :attribute must be the same as the password_confirmation field!',
			'password.min' => 'A :attribute min lenght is 6!',
			'password' => [
				'letters' => 'The :attribute must contain at least one letter!',
				'mixed' => 'The :attribute must contain at least one uppercase and one lowercase letter!',
				'numbers' => 'The :attribute must contain at least one number!',
				'uncompromised' => 'The given :attribute has appeared in a data leak! Please choose a another :attribute.',
			],
			'password_confirmation.required_with' => 'The :attribute field is required when :values is present and filled!',
		];
	}

	protected function prepareForValidation()
	{
		if ($this->password === null) {
			$this->request->remove('password');
			$this->request->remove('password_confirmation');
		}
	}
}
