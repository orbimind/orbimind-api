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
            'username' => 'nullable|unique:users,username',
            'name' => 'nullable|alpha',
            'email' => 'nullable|email|unique:users,email',
            'password' => 'nullable|min:8|confirmed',
            'role' => 'nullable|alpha|in:user,admin'
        ];
    }
}
