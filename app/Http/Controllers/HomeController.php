<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\UserClinic;
use Auth;
use Carbon\Carbon;


class HomeController extends Controller
{

    public function index()
    {
        $user_id = Auth::id();
        $now = new Carbon;

        $clinic_data = UserClinic::where('user_id', $user_id)->get();

        if(!$clinic_data->isEmpty())
        {
            foreach($clinic_data as $clinic)
            {
               $user_clinic[$clinic->clinic_id] = Clinic::where('id',$clinic->clinic_id)->get();
            }

           return view('user/home')->with('data',['user_clinic' => $user_clinic, 'clinic' => '1' , 'home_page' => '1']);
        }else{

            return view('user/home')->with('data',['clinic' => 0]);

        }
}

}
