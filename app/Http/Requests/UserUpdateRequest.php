<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'string|unique:users,username',
            'name' => 'alpha',
            'email' => 'email|unique:users,email',
            'password' => 'min:8|confirmed',
            'role' => 'alpha|in:user,admin'
        ];
    }
}
