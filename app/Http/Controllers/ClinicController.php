<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRegisterRequest;
use Auth;

use App\Models\Clinic;
use App\Models\User;
use App\Models\Role;
use App\Models\Master;

class ClinicController extends Controller
{
    public function index()
    {
        $userData = User::all();
        return view('user/index')->with('data',$userData);
    }

    public function register(RegisterRequest $request) 
    {
        $clinic = Clinic::create($request->validated());
        return redirect('/')->with('success', "Clinic successfully registered.");
    }

    public function newUser(){
        $id = Clinic::where('id', auth()->user()->id)->pluck('package_id')->first();
        $package_id= "pr-".$id;
       // $data = Master::where('key', $package_id)->pluck('value')->toJson();
        // print_r($data);
        // foreach ($data as $row){
        //     print_r($row);
        // }
        $data = '[["doctor","{patinet::create}"], ["staff", "{create}"], ["pharmacist","{create}"]]';


        
        return view('user/new')->with('data',$data);
    }

    public function registerUser(UserRegisterRequest $request)
    {

        // if ($request->validated()) {
        //     echo "Hello";
        // }else{
        //     echo "Not helllo";
        // }
        // $user = User::create();
        // return redirect('/')->with('success', "Clinic successfully registered.");

        $role_id = Role::create(['role_type' => $request->role_type, 'permissions' => '1,2,3'])->id;
        
        $user = new User();

        $user->create(['name' => $request->name, 
                        'clinic_id' => Auth::id(),
                        'role_id' => $role_id,
                        'code' => $request->code,
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => $request->password,
                        'phoneNumber' => $request->phoneNumber,
                        'city' => $request->city,
                        'country' => $request->country,
                        'address' => $request->address,
                        'gender' => $request->gender
                    ]);
        
        return redirect('/users')->with('success', "Registered Successfully?");



    }

    public function logout()
    {
        // Session::flush();
        
        Auth::logout();

        return redirect('/');
    }




}
