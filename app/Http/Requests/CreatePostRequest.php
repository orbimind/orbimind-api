<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:64',
            'content' => 'required|string|max:4096',
            'category_id' => 'required|array|max:10'
        ];
    }
}
