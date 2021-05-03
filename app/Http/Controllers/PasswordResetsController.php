<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;
use App\Models\PasswordResets;
use Illuminate\Support\Str;
use App\Models\User;

class PasswordResetsController extends Controller
{
    public function ForgotPassword(ForgotPasswordRequest $request)
    {
        $email = $request->input('email');
        $token = Str::random(10);

        try {
            if (PasswordResets::where('email', $email)->first()) {
                PasswordResets::where('email', $email)->update(['token' => $token]);
            } else {
                PasswordResets::insert([
                    'email' => $email,
                    'token' => $token
                ]);
            }

            $data = [
                'link' => URL::current() . '/' . $token,
            ];
            $user['email'] = $email;
            Mail::send('forgot', $data, function ($message) use ($user) {
                $message->to($user['email']);
                $message->subject('Password reset confirmation');
            });

            return response([
                'message' => 'Password reset confirmation sent to ' . $email . '!'
            ]);
        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    public function ResetPassword(ResetPasswordRequest $request, $token)
    {
        try {
            if (!$data = PasswordResets::where('token', $token)->first()) {
                return response([
                    'message' => 'Invalid token!'
                ], 400);
            }

            /** @var User $user */
            if (!$user = User::where('email', $data->email)->first()) {
                return response([
                    'message' => 'User does not exist!'
                ], 404);
            }

            $user->password = Hash::make($request->input('password'));
            $user->save();

            PasswordResets::where('email', $data->email)->delete();
        } catch (\Exception $exception) {
            return response([
                'message' => $exception->getMessage()
            ], 400);
        }

        return response([
            'message' => 'Password reset successful'
        ]);
    }
}