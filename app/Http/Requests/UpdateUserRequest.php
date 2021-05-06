<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'string|unique:users,username|max:10',
            'name' => 'alpha|max:20',
            'email' => 'email|unique:users,email|max:64',
            'password' => 'min:8|confirmed'
        ];
    }
}
