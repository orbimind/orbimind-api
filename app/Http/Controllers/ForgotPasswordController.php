<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\ForgotPasswordRequest;

use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function ForgotPassword(ForgotPasswordRequest $request)
    {
        $email = $request->input('email');

    }

    public function ResetPassword(Request $request)
    {

    }
}
