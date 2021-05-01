<?php

namespace App\Http\Controllers;

use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use App\Models\User;
use Mail;

class ForgotPasswordController extends Controller
{
    public function ForgotPassword(ForgotPasswordRequest $request)
    {
        $email = $request->input('email');
        $token = Str::random(10);

        try {
            if(DB::table('password_resets')->exists('email', $email)){
                DB::table('password_resets')->where('email', $email)->update(['token' => $token]);
            }
            else {
                DB::table('password_resets')->insert([
                    'email' => $email,
                    'token' => $token
                ]);
            }

            $data = [
                'link'=>URL::current().'/'.$token,
            ];
            $user['email'] = $email;
            Mail::send('forgot', $data, function ($message) use ($user) {
                $message->to($user['email']);
                $message->subject('Password reset confirmation');
            });

            return response([
                'message' => 'Password reset confirmation sent to '.$email.'!'
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
            if(!$data = DB::table('password_resets')->where('token', $token)->first()){
                return response([
                    'message' => 'Invalid token!'
                ], 400);
            }

            /** @var User $user */
            if(!$user = User::where('email', $data->email)->first()) {
                return response([
                    'message' => 'User does not exist!'
                ], 404);
            }

            $user->password = Hash::make($request->input('password'));
            $user->save();

            DB::table('password_resets')->where('email', $data->email)->delete();
        } catch(\Exception $exception) {
            return response([
                'message' => 'Error while processing data'
            ], 400);
        }

        return response([
            'message' => 'Password reset successful'
        ]);
    }
}
