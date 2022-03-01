<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Models\Clinic;

use Auth;

class LoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        if($request->validated())
        {
            $data = Clinic::where("code",'=',$request->code)->get();

            if(count($data) == 0)
            {
                return redirect('/')->with('message', "User does not exists");
            }else{
                $userCredentials = $request->only('code', 'password');

                if(Auth::attempt($userCredentials)){
                    return redirect('/clinic-home')->with('message', "");
                }else{
                    return redirect('/')->with('message', "Invalid Credentials");
                }

               
                
            }
            
        }

    }


}
