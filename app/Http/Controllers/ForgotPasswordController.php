<?php

namespace App\Http\Controllers;

use App\Mail\PasswordResetMail;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showForgetPassword()
    {
        return view('login.forgot-password');
    }

    public function submitForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:user',
        ]);

        $recipient = $request->email;
        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $recipient,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        $mailData = [
            'recipient' => $recipient,
            'token' => $token,
            'fromEmail' => 'aungmyin.cm@gmail.com',
            'fromName' => 'Aung Myin Authentication',
            'subject' => 'Reset Password',
        ];

        Mail::to($recipient)->send(new PasswordResetMail($mailData));

        return back()->with('success', 'We have emailed your password reset link!');
    }

    public function showResetPassword($token)
    {
        return view('login.reset-password', ['token' => $token]);
    }

    public function submitResetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:user',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = DB::table('password_reset_tokens')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])->first();

        if (!$updatePassword) {
            return back()->withErrors(['email' => 'Invalid token!'])->onlyInput('email');
        }

        $user = User::where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect('/login')->with('success', 'Your password has been changed!');
    }
}
