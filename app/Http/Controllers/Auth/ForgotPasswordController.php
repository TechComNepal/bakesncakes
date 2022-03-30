<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        $this->setpageTitle('Forgot Password');
        return view('auth.forgotPassword');
    }

    public function submitForgotPasswordForm(Request $request)
    {
        $request->validate([
          'email'=>'required|email|exists:users,email',
        ]);
        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('emails.auth.forgotPassword', ['token'=>$token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });
        return back()->with('status', 'We have e-mailed your password reset link!');
    }


    public function showResetPasswordForm($token)
    {
        $this->setPagetitle('Reset Password');
        return view('auth.resetPassword', ['token' => $token]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
          'email'=>'required|email|exists:users,email',
          'password'=>['required',
           Password::min(8)->letters()->numbers()->mixedCase()->symbols()->uncompromised()],
           'password_confirmation'=>'required|same:password',
      ]);

        $updatePassword= DB::table('password_resets')->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user=User::where('email', $request->email)
              ->update(['password'=>Hash::make($request->password)]);

        DB::table('password_resets')->where(['email'=> $request->email])->delete();
        return redirect('/login')->with('message', 'Your password has been changed!');
    }
}
