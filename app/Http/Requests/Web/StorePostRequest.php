<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return auth()->check();
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules()
	{
		return [
			'title' => 'bail|required|string|min:5|max:150',
			'text' => 'bail|required|string|min:10',
		];
	}

	public function attributes()
	{
		return [
			'title' => 'Header',
			'text' => 'Content',
		];
	}
}
