<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Clinic;
use App\Models\Patient;
use Auth;

class HomeController extends Controller
{

    public function index()
    {        
        $role = Role::where('id', Auth::guard('user')->user()['role_id'])->get()->first();
        $clinic_code = Clinic::where('id' , Auth::guard('user')->user()['clinic_id'])->pluck('code');
        if($role->role_type == 2) {     
            $patientData = Patient::where('clinic_code' ,$clinic_code)->where('p_status' , 1)->where('status' , 1)->get();
        }else{
            $patientData = "";
        }
        return view('user/home')->with('data',$patientData);
    }

}
