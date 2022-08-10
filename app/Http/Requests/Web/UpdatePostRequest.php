<?php

namespace App\Http\Requests\Web;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		$post = Post::find($this->route('post')->id);

		return $post && $this->user()->can('update', $post);
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules()
	{
		return [
			'title' => 'bail|sometimes|string|min:5|max:150',
			'text' => 'bail|sometimes|string|min:10',
		];
	}
}
