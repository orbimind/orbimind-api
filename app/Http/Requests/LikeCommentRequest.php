<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LikeCommentRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_id' => 'required|integer',
            'comment_id' => 'integer',
            'type' => 'required|alpha|in:like,dislike'
        ];
    }
}
