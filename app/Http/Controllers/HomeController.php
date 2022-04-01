<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Clinic;


use Auth;

class HomeController extends Controller
{

    public function index()
    {        
        return view('user/home');
    }

}
