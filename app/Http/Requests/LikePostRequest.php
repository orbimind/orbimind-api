<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LikePostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|integer',
            'post_id' => 'integer',
            'type' => 'required|alpha|in:like,dislike'
        ];
    }
}
