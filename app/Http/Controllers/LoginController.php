<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\Clinic;

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

    public function clinicLogin(LoginRequest $request)
    {
        if($request->validated())
        {
            $data = Clinic::where("code",'=',$request->code)->get();

            if(count($data) == 0)
            {
                return redirect('clinic-login')->with('message', "User does not exists");
            }else{
                $userCredentials = $request->only('code', 'password');

                if(Auth::guard('clinic')->attempt($userCredentials)){
                    return redirect('dashboard')->with('message', "");
                }else{
                    return redirect('clinic-login')->with('message', "Invalid Credentials");
                }
            }
        }
    }

    public function userLogin(LoginRequest $request)
    {
        if($request->validated())
        {
            $data = User::where("code",'=',$request->code)->get();

            if(count($data) == 0)
            {
                return redirect('/')->with('message', "User does not exists");
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

    public function clinicLogout()
    {        
        Auth::guard('clinic')->logout();

        return redirect('/clinic-login');
    }

    public function userLogout(Request $request)
    {                
        Session::flush();

        Auth::logout();

        return redirect(\URL::previous());

    }
}
