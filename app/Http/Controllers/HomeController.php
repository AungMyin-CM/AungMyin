<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Clinic;
use App\Models\Patient;
use Auth;
use Carbon\Carbon;


class HomeController extends Controller
{

    // public function index()
    // {        
    //     $role = Role::where('id', Auth::guard('user')->user()['role_id'])->get()->first();
    //     $clinic_code = Clinic::where('id' , Auth::guard('user')->user()['clinic_id'])->pluck('code');
    //     $user_id = Auth::guard('user')->user()['id'];
    //     $now = new Carbon;

    //     if($role->role_type == 2) {     

    //         $patientData = Patient::where('clinic_code' ,$clinic_code)
    //                         ->where('user_id',$user_id)
    //                         ->where('p_status' , 1)
    //                         ->where('updated_at' , '>=' ,$now->format('ymd') )
    //                         ->where('status', 1)->get();

    //     }elseif($role->role_type == 1){

    //         $patientData = Patient::where('clinic_code' ,$clinic_code)
    //                         ->where('p_status' , 2)->where('status' , 1)
    //                         ->where('updated_at' , '>=' ,$now->format('ymd') )
    //                         ->where('status', 1)->get();    
    //     }elseif($role->role_type == 3){

    //         $patientData = Patient::where('clinic_code' ,$clinic_code)
    //                         ->where('p_status' , 3)->where('status' , 1)
    //                         ->where('updated_at' , '>=' ,$now->format('ymd') )
    //                         ->where('status', 1)->get();           
    //     }else{
    //         $patientData = "";
    //     }
    //     return view('user/home')->with('data',['patientData' => $patientData, 'role' => $role->role_type]);
    // }

    public function index()
    {
        $user_id = Auth::id();
        $now = new Carbon;

        return view('user/home');
}

}
