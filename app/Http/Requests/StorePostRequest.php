<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
	public function rules()
    {
        return [
            'title' => ['required', 'string', 'min:8'],
            'body' => ['required', 'string', 'min:10'],
        ];
    }
}
