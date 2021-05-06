<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'string|max:64',
            'content' => 'string|max:4069',
            'category_id' => 'array|max:10',
            'status' => 'boolean'
        ];
    }
}
