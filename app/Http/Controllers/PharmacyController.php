<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Clinic;
use App\Models\Pharmacy;

use Auth;

class PharmacyController extends Controller
{
    public function index(Request $request)
    {

        if(!$this->checkPermission('ph_view')){
            abort(403);
        }
        
        $clinic_id = Auth::guard('user')->user()['clinic_id'];

        $pharmacyData =  Pharmacy::where("clinic_id",$clinic_id)->where('status',1)->get();
        
        return view('pharmacy/index')->with('data',$pharmacyData);
    }

    public function create(Request $request)
    {
        if(!$this->checkPermission('ph_create')){
            abort(403);
        }

        return view('pharmacy/new');    
    }
}
