<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\Clinic;
use Illuminate\Support\Facades\Hash;

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

    public function index(){
        return view('login/user');
    }


    public function login(LoginRequest $request)
    {
        if($request->validated())
        {
            $data = User::where("code",'=',$request->code)->get()->first();

            if($data == null)
            {
                return redirect('/')->with('message', "User does not exists");
            }elseif($data->email_verified == 0){
                return redirect('/')->with('alert', "Please verify your email");
            }else{
                    $userCredentials = $request->only('code', 'password');

                    if(Auth::guard('user')->attempt($userCredentials)){
                        
                        return redirect('home')->with('message', "");
                    }else{
                        return redirect('/')->with('message', "Invalid Credentials");
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
