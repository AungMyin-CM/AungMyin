<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\Clinic;
use App\Models\UserClinic;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

use Illuminate\Support\Facades\Session;
use Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        // $this->middleware('guest')->except('userlogout');
        // $this->middleware('guest:user')->except('userlogout');
        // $this->middleware('guest:clinic')->except('userlogout');
    }

    public function index()
    {
        return view('login/user');
    }

    public function login(LoginRequest $request)
    {
        if ($request->validated()) {
            $data = User::where("email", $request->email)->get()->first();

            if ($data == null) {
                return back()->withErrors(['email' => 'User does not exists!'])->onlyInput('email');
            } elseif ($data->email_verified == 0) {
                return back()->withErrors(['email' => 'Please verify your email'])->onlyInput('email');
            } else {
                $userCredentials = $request->only('email', 'password');

                if (Auth::guard('user')->attempt($userCredentials)) {
                    $user_clinic = UserClinic::where('user_id', Auth::id())->first();
                    $count_user_clinic = UserClinic::where('user_id', Auth::id())->count();

                    if ($count_user_clinic == 1) {
                        return redirect('/clinic-system/' . Crypt::encrypt($user_clinic->clinic_id))->with('message', "");
                    } else {
                        return redirect('/home');
                    }
                } else {
                    return back()->withErrors(['email' => 'Invalid Credentials!'])->onlyInput('email');
                }
            }
        }
    }

    public function logout()
    {
        Auth::guard('user')->logout();

        Session::flush();

        return redirect(\URL::previous());
    }
}
