<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username' => 'required|string|unique:users,username|max:10',
            'name' => 'required|alpha|max:20',
            'email' => 'required|email|unique:users,email|max:64',
            'password' => 'required|min:8|confirmed'
        ];
    }
}
