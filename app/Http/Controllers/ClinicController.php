<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRegisterRequest;
use Auth;

use App\Models\Clinic;
use App\Models\User;
use App\Models\PackagePurchase;
use App\Models\UserClinic;
use App\Models\Patient;
use App\Models\Role;
use App\Models\Master;
use App\Models\Package;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

use Session;

class ClinicController extends Controller
{

    public function dashboard()
    {
        return view('clinic.dashboard');

    }

    public function index(Request $request)
    {        
        if(Auth::user()->role_id != null){

            $role = Role::where('id', Auth::guard('user')->user()['role_id'])->get()->first();

            try {
                $clinic_id = Crypt::decrypt($request->code);
                session()->put('cc_id', $clinic_id);
            } catch (DecryptException $e) {
                abort(404);
            }            
            
            $clinic_code = Clinic::where('id',$clinic_id)->pluck('code');
            $user_id = Auth::guard('user')->user()['id'];
            $now = new Carbon;

            if($role->role_type == 2 || $role->role_type == 5) {     

                $patientData = Patient::where('clinic_code' ,$clinic_id)
                                ->where('user_id',$user_id)
                                ->where('p_status' , 1)
                                ->where('updated_at' , '>=' ,$now->format('ymd'))
                                ->where('status', 1)->get();

            }elseif($role->role_type == 1 || $role->role_type == 5){

                $patientData = Patient::where('clinic_code' ,$clinic_id)
                                ->where('p_status' , 2)->where('status' , 1)
                                ->where('updated_at' , '>=' ,$now->format('ymd') )
                                ->where('status', 1)->get();    
            }elseif($role->role_type == 3 || $role->role_type == 5){

                $patientData = Patient::where('clinic_code' ,$clinic_id)
                                ->where('p_status' , 3)->where('status' , 1)
                                ->where('updated_at' , '>=' ,$now->format('ymd') )
                                ->where('status', 1)->get();           
            }else{
                $patientData = "";
            }
            return view('user/clinic')->with('data',['patientData' => $patientData, 'role' => $role->role_type]);

        }else{

            return view('user/clinic')->with('data',['patientData' => 0]);

        
        }
    }

    public function register(Request $request)
    {

        $user_id = Auth::guard('user')->user()['id'];
        $clinic = new Clinic();
        $package = Package::find($request->package_id)->first();

        $permissions = ["p_view","p_create","p_update","p_delete","p_treatment","d_view","d_create",
        "d_update","d_delete","ph_view",
        "ph_create","ph_update","ph_delete","pos_view","pos_create","pos_update","pos_delete"];

        $role_id = Role::create(['role_type' => '5', 'permissions' => json_encode($permissions)])->id;

        $clinic_id = $clinic->create([
            'code' => $request->clinic_name.'-'.$this->generateClinicCode(),
            'name' => $request->clinic_name,
            'email' => Auth::user()->email,
            'phoneNumber' => Auth::user()->phoneNumber,
            'package_id' => $request->package_id,
            'address' => $request->address,
            'package_purchased_data' => Carbon::now(),
        ])->id;

        $now = Carbon::now()->format('Y-m-d');

        PackagePurchase::create([
            'user_id' => $user_id,
            'clinic_id' => $clinic_id,
            'price' => $package['price'],
            'expire_at' => Carbon::parse($now)->addMonths(1),
        ]);

        UserClinic::create([
            'user_id' => $user_id,
            'clinic_id' => $clinic_id,
        ]);

        User::where('id',$user_id)->update(['user_type' => '3', 'role_id' => $role_id]); // (user-type) 1 = normal-user 2 = added_from_clinic 3 = own_clinic

        return redirect('home')->with('success', "Clinic successfully registered.");
    }

    public function newUser()
    {

        $id = Clinic::where('id', session()->get('cc_id'))->pluck('package_id')->first();

        $data = ['1' => 'doctor', '2' => 'receptionist', '3' => 'pharmacist', '4' => 'staff'];

        return view('user/new')->with('data', $data);
    }

    public function registerUser(UserRegisterRequest $request)
    {
        $permissions = json_encode($request->permission);

        $role_id = Role::create(['role_type' => $request->role_type, 'permissions' => $permissions])->id;

        $clinic_id = session()->get('cc_id');

        $user = new User();

        $user_id = $user->create([
            'name' => $request->name,
            'role_id' => $role_id,
            'speciality' => $request->speciality,
            'credentials' => $request->credentials,
            'code' => $this->userCodeGenerator(),
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'phoneNumber' => $request->phoneNumber,
            'city' => $request->city,
            'country' => $request->country,
            'address' => $request->address,
            'short_bio' => $request->short_bio,
            'fees' => $request->fees,
            'user_type' => 2, // (user-type) 1 = normal-user 2 = added_from_clinic 3 = own_clinic
            'gender' => $request->gender
        ])->id;

        UserClinic::create([
            'user_id' => $user_id,
            'clinic_id' => $clinic_id,
        ]);

        return redirect('/clinic-system/users')->with('success', "Registered Successfully");
    }

    public function editUser($id)
    {
        $user = User::findOrfail($id);
        $data = ['1' => 'doctor', '2' => 'receptionist', '3' => 'pharmacist', '4' => 'staff'];

        $role = Role::where('id', $user->role_id)->get()->first();
        return view('user/edit', compact('user', 'data', 'role'));
    }

    public function updateUser(Request $request, $id)
    {

        $permissions = json_encode($request->permission);
        $origin_password = User::where('id', $id)->pluck('password');

        $role_id = Role::whereId($id)->update(['role_type' => $request->role_type, 'permissions' => $permissions]);

        $requests = [
            'name' => $request->name,
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

        return redirect('clinic-system/users')->with('success', 'Done !');
    }

    public function deleteUser($id)
    {
        User::whereId($id)->update(['status' => '0', 'deleted_at' => Carbon::now()]);

        return redirect('clinic-system/users')->with('success', 'Done !');
    }


    public function stepOneRegister()
    {

        $data = Package::where('status', 1)->get();

        return view('registration/clinic_name')->with('data', $data);
    }

    public function stepTwoRegister(Request $request)
    {
        try {
            $package_id = Crypt::decrypt($request->_token);
        } catch (DecryptException $e) {
            abort(404);
        }

        $free_month = $request->value;

        $payments = ['1_k' => 'kpay', '2_w' => 'wpay', '3_c' => 'cod' ];

        return view('registration/clinic_registration')->with('data', ['package_id' => $package_id, 'payment_types' => $payments, 'free_month' => $free_month]);
    }

    public function generateClinicCode($count = 7)
    {
        $code = Str::random($count);

        return $code;
    }

    private function userCodeGenerator()
    {
        $timestamp = Carbon::now();
        $current_date = $timestamp->format('u');
        $clinic_id = session()->get('cc_id');

        $c_name = Clinic::select('name')->where('id',$clinic_id)->first();

        $patient_code = str_replace(' ','',$c_name->name).":u:".$current_date;

        return $patient_code;

    }
}