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
            'user_id' => 'required|integer',
            'title' => 'required|string',
            'content' => 'required|string',
            'category_id' => 'required|array|numeric'
        ];
    }
}
