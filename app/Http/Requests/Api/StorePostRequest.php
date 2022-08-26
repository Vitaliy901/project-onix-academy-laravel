<?php

namespace App\Http\Requests\Api;

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
		return $this->user()->tokenCan('publish');
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
			'keywords' => 'sometimes|string',
			'text' => 'bail|required|string|min:10',
			'cover.*' => 'bail|sometimes|file|mimes:jpeg,gif,png',
			'tags' => ['sometimes', 'array']
		];
	}

	public function messages()
	{
		return [
			'title.required' => 'A :attribute is required!',
			'title.min' => 'A :attribute min lenght is 5!',
			'title.max' => 'A :attribute max lenght is 150!',
			'title.string' => 'A :attribute should be string only !',
			'keywords.string' => 'A :attribute should be string only!',
			'text.required' => 'A :attribute is required!',
			'text.min' => 'A :attribute min lenght is 10!',
			'text.string' => 'A :attribute should be string only!',
			'cover.file' => 'A :attribute only accepts file',
			'cover.mimes' => 'A :attribute only accepts the following types: jpeg,gif,png',
		];
	}

	protected function prepareForValidation()
	{
		if ($this->keywords === null) {
			$this->request->remove('keywords');
		}
		if ($this->cover === null) {
			$this->request->remove('cover');
		}
	}
}
