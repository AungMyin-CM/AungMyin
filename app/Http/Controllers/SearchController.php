<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\Pharmacy;
use App\Models\UserClinic;
use App\Models\Role;

use Carbon\Carbon;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;

use Illuminate\Support\Str;

use Auth;

class SearchController extends Controller
{
    public function searchPatient(Request $request)
    {
        $ref = str_replace(' ', '_', $request->key);

        $clinic_id = UserClinic::where('user_id', $request->clinic_id)->pluck('clinic_id')->first();

        $data = Patient::select('id', 'name', 'age', 'father_name')->where('Ref', 'like', '%' . $ref . '%')->where('clinic_code', $clinic_id)->where('status', 1)->get();

        $role = Role::where('id', Auth::guard('user')->user()['role_id'])->get()->first();

        if ($role->role_type == 1) {

            if (count($data) == 0) {
                $output = '';
            } else {
                $output = '<ul class="list-group" style="display:block;">';
                // <li class="list-group-item search-get-results-1-result"><span class="col-md-4 float-left">Name</span><span class="col-md-4">Age</span><span class="col-md-4 float-right">Father\'s Name</span></li>';

                foreach ($data as $row) {
                    $output .= '
                        
                        <li class="list-group-item"><a href="' . route('patient.treatment', Crypt::encrypt($row->id)) . '"><div class="row"><span class="col-md-4">' . $row->name . '</span>' . '<span class="col-md-4">' . $row->age . '</span>' . '<span class="col-md-4">' . $row->father_name . '</span></div></a></li>
                    ';
                }
                $output .= '</ul>';
            }
        } elseif ($role->role_type == 2) {

            if (count($data) == 0) {
                $output = '';
            } else {
                $output = '<ul class="list-group" style="display:block; position:relative;">';

                foreach ($data as $row) {
                    $output .= '
                        <li class="list-group-item bg-secondary text-black"> <div class="row">              
                        <a  class="col-md-11 row" href="' . route('patient.edit', Crypt::encrypt($row->id)) . '" style="color:#000 !important;">     <span class="col-lg-4">' . Str::title($row->name) . '</span>' .
                        '<span class="col-lg-4">Age: ' . $row->age . '</span>' .
                        '<span class="col-lg-4">Father\'s Name: ' . $row->father_name . '</span>                 
                        </a>  
                        <a class="col-md-1" href="' . route('add.queue', $row->id) . '" class="btn btn-sm btn-tool">
                        <i class="fas fa-users fa-lg" style="color:black;"></i>
                        </a>
                        </div>
                        </li>';
                }
                $output .= '</ul>';
            }
        } else if ($role->role_type == 3) {
            if (count($data) == 0) {
                $output = '';
            } else {
                $output = '<ul class="list-group" style="display:block; position:relative;">';

                foreach ($data as $row) {
                    $output .= '
                        <li class="list-group-item bg-secondary"><a href="' . route('pos-patient', Crypt::encrypt($row->id)) . '" style="color:#000 !important;"><div class="row"><span class="col-md-4">' . Str::title($row->name) . '</span>' . '<span class="col-md-4">Age: ' . $row->age . '</span>' . '<span class="col-md-4">Father\'s Name: ' . $row->father_name . '</span></div></a></li>
                    ';
                }
                $output .= '</ul>';
            }
        } else if ($role->role_type == 5) {

            if (count($data) == 0) {
                $output = '';
            } else {
                $output = '<ul class="list-group" style="display:block; position:relative;">';

                foreach ($data as $row) {
                    $output .= '
                        <li class="list-group-item bg-secondary"><a href="' . route('patient.treatment', Crypt::encrypt($row->id)) . '" style="color:#000 !important;"><div class="row"><span class="col-md-4">' . Str::title($row->name) . '</span>' . '<span class="col-md-4">Age: ' . $row->age . '</span>' . '<span class="col-md-4">Father\'s Name: ' . $row->father_name . '</span></div></a></li>
                    ';
                }
                $output .= '</ul>';
            }
        }

        echo $output;
    }

    public function searchMedicine(Request $request)
    {

        $ref = str_replace(' ', '_', $request->key);

        $clinic_id = $request->clinic_id;

        $timestamp = Carbon::now();
        $current_date = $timestamp->format('y-m-d');

        $row_id = $request->rowid;

        $data = Pharmacy::select('id', 'name', 'code')->where('Ref', 'like', '%' . $ref . '%')->where('clinic_id', $clinic_id)->where('quantity', '>', '0')->where('expire_date', '>', $current_date)->where('status', 1)->get();

        if (count($data) == 0) {
            $output = '';
        } else {
            $output = '<ul class="list-group" style="display:block; position:relative;">';

            foreach ($data as $row) {
                $output .= '
                    <li class="list-group-item" id="item_options" data-id =' . $row->id . '  data-name =' . $row->name . ' row-id=' . $row_id . ' onclick="s_option(this)" style="background-color:#f3f3f3;cursor:pointer;"><span>' . $row->name . '</span></li>
                ';
            }
            $output .= '</ul>';
        }

        echo $output;
    }

    public function searchMedPatient(Request $request)
    {
        $ref = str_replace(' ', '_', $request->key);

        $clinic_id = $request->clinic_id;

        $data = Patient::select('*')->where('Ref', 'like', '%' . $ref . '%')->where('clinic_code', $clinic_id)->where('status', 1)->get();

        if (count($data) == 0) {
            $output = '';
        }else{  
            $output = '<ul class="list-group" id="patient_group" style="display:block; position:relative;">';

            foreach ($data as $row) {
                $output .= '
                    <li class="list-group-item" onclick="getPatientData('.$row->id.')">
                        <div class="row" id="p_data_'.$row->id.'"> 
                            <span class="col-md-4" data-name= "'.$row->name.'"  id= "name_'.$row->id.'">'.Str::title($row->name).'</span>
                            <span class="col-md-4" data-age= "'.$row->age.'"  id= "age_'.$row->id.'">Age: '.$row->age.'</span>
                            <span class="col-md-4" data-f_name= "'.$row->father_name.'"  id= "father_name_'.$row->id.'">Father\'s Name: '.$row->father_name.'</span>
                            <span hidden  id= "patient_id_'.$row->id.'">'.$row->id.'</span>
                            <span hidden  id= "gender_'.$row->id.'">'.$row->gender.'</span>
                            <span hidden  id= "phoneNumber_'.$row->id.'">'.$row->phoneNumber.'</span>
                            <span hidden  id= "address_'.$row->id.'">'.$row->address.'</span>
                            <span hidden  id= "allergy_'.$row->id.'">'.$row->drug_allergy.'</span>
                        </div>
                    </li>';
            }
            $output .= '</ul>';
        }

        echo $output;
    }
}