<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\UserClinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{

    public function index()
    {
        $user_id = Auth::id();
        $now = new Carbon;

        session()->forget('cc_id');

        $user_clinic = UserClinic::where('user_id', $user_id)->with('expire')->with('clinic')->get();

        return view('user/home')->with('data',['user_clinic' => $user_clinic, 'clinic' => '1' , 'home_page' => '1']);

    }

    public function welcome()
    {
        return view('welcome');
    }

}
