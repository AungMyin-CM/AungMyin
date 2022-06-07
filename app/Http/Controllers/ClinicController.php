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
use App\Models\Package;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

use Illuminate\Support\Facades\Hash;


class ClinicController extends Controller
{
    public function index()
    {
        $userData = User::where('clinic_id', Auth::guard('user')->user()['id'])->get();
        return view('user/index')->with('data',$userData);
    }

    public function register(RegisterRequest $request) 
    {
        $clinic = Clinic::create($request->validated());
        return redirect('/clinic-login')->with('success', "Clinic successfully registered.");
    }

    public function newUser(){
        
        $id = Clinic::where('id', Auth::guard('user')->user()['id'])->pluck('package_id')->first();
       
        $data = ['1' => 'doctor','2' => 'receptionist','3' => 'pharmacist', '4' => 'staff'];

        return view('user/new')->with('data', $data);
    }

    public function registerUser(UserRegisterRequest $request)
    {
        $permissions = json_encode($request->permission);

        $role_id = Role::create(['role_type' => $request->role_type, 'permissions' => $permissions])->id;
        
        $user = new User();

        $user->create(['name' => $request->name, 
                        'clinic_id' => Auth::guard('user')->user()['id'],
                        'role_id' => $role_id,
                        'speciality' => $request->speciality,
                        'credentials' => $request->credentials,
                        'code' => $request->code,
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => $request->password,
                        'phoneNumber' => $request->phoneNumber,
                        'city' => $request->city,
                        'country' => $request->country,
                        'address' => $request->address,
                        'short_bio' => $request->short_bio,
                        'fees' => $request->fees,
                        'gender' => $request->gender
                    ]);
        
        return redirect('/users')->with('success', "Registered Successfully");

    }

    public function editUser($id)
    {
        $user = User::findOrfail($id);
        $data = ['1' => 'doctor','2' => 'receptionist','3' => 'pharmacist', '4' => 'staff'];
        
        $role = Role::where('id',$user->role_id)->get()->first();
        return view('user/edit',compact('user','data', 'role'));
    }

    public function updateUser(Request $request, $id)
    {

        $permissions = json_encode($request->permission);
        $origin_password = User::where('id',$id)->pluck('password');

        $role_id = Role::whereId($id)->update(['role_type' => $request->role_type, 'permissions' => $permissions]);

        $requests = ['name' => $request->name, 
                        'clinic_id' => Auth::guard('user')->user()['id'],
                        'code' => $request->code,
                        'speciality' => $request->speciality,
                        'credentials' => $request->credentials,
                        'name' => $request->name,
                        'email' => $request->email,
                        'phoneNumber' => $request->phoneNumber,
                        'city' => $request->city,
                        'country' => $request->country,
                        'address' => $request->address,
                        'gender' => $request->gender,
                        'short_bio' => $request->short_bio,
                        'fees' => $request->fees,
                    ];

        if ($request->password != null && trim($request->password) != '') {
            $requests += ['password' => Hash::make($request->password)];
        }

        User::whereId($id)->update($requests);

        return redirect('users')->with('success', 'Done !');

    }


    public function stepOneRegister()
    {

        $data = Package::where('status', 1)->get();

        return view('registration/clinic_name')->with('data',$data);

    }

    public function stepTwoRegister(Request $request)
    {
        // $name = explode(' ',$request->clinic_name);
        
        // try {
        //     $package_id = Crypt::decrypt($request->plan);

        // }catch(DecryptException $e){
        //     abort(404);
        // }
        
        // if(count($name)==1){

        //     $clinicCode1 = substr($name[0] ,0,4 ).$this->generateClinicCode();
        //     $clinicCode2 = substr($name[0] ,0,4 ).$this->generateClinicCode();
        //     $clinicCode3 = substr($name[0] ,0,2 ).$this->generateClinicCode(6);

        // }else{
        //     $clinicCode1 = substr($name[0] ,0,4 ).$this->generateClinicCode();
        //     $clinicCode2 = substr($name[1] ,0,4 ).$this->generateClinicCode();
        //     $clinicCode3 = substr($name[0] ,0,1 ).substr($name[1] ,0,1 ).$this->generateClinicCode();

        // }
        return redirect('payment')->with('message', "");
        // return view('registration/clinic_registration')->with('data',['name' => $request->clinic_name, 'package_id' => $package_id, 'clinicCode1' => $clinicCode1, 'clinicCode2' => $clinicCode2, 'clinicCode3' => $clinicCode3 , 'style' => 'font-size: 100% !important; cursor: pointer;']);
    }


    public function payment()
    {
        // $name = explode(' ',$request->clinic_name);
        
        // try {
        //     $package_id = Crypt::decrypt($request->plan);

        // }catch(DecryptException $e){
        //     abort(404);
        // }
        
        // if(count($name)==1){

        //     $clinicCode1 = substr($name[0] ,0,4 ).$this->generateClinicCode();
        //     $clinicCode2 = substr($name[0] ,0,4 ).$this->generateClinicCode();
        //     $clinicCode3 = substr($name[0] ,0,2 ).$this->generateClinicCode(6);

        // }else{
        //     $clinicCode1 = substr($name[0] ,0,4 ).$this->generateClinicCode();
        //     $clinicCode2 = substr($name[1] ,0,4 ).$this->generateClinicCode();
        //     $clinicCode3 = substr($name[0] ,0,1 ).substr($name[1] ,0,1 ).$this->generateClinicCode();

        // }
        return view('register/payment')->with('message', "");
        // return view('registration/clinic_registration')->with('data',['name' => $request->clinic_name, 'package_id' => $package_id, 'clinicCode1' => $clinicCode1, 'clinicCode2' => $clinicCode2, 'clinicCode3' => $clinicCode3 , 'style' => 'font-size: 100% !important; cursor: pointer;']);
    }


    private function generateClinicCode($count = 4)
    {

        $code = Str::random($count);

        return $code;

    }
}
