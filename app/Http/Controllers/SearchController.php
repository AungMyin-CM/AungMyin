<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinic;
use App\Models\Patient;
use App\Models\Pharmacy;

use Carbon\Carbon;


use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;


class SearchController extends Controller
{

    public function searchPatient(Request $request)
    {
        $ref = str_replace(' ','_',$request->key);

        $clinic_id = $request->clinic_id;

        $clinic_code = Clinic::where('id',$clinic_id)->pluck('code');

        $data = Patient::select('id','name','age','father_name')->
                where('Ref', 'like', '%'.$ref.'%')->
                where('clinic_code',$clinic_code)->
                where('status',1)->
                get();

        if(count($data) == 0)
        {
            $output = '';
        }else{  
            $output = '<ul class="list-group" style="display:block; position:relative;">';

            foreach($data as $row)
            {
                $output .= '
                    <li class="list-group-item"><a href="'.route('patient.treatment', Crypt::encrypt($row->id)).'"><div class="row"><span class="col-md-4">Name: '.$row->name.'</span>'.'<span class="col-md-4">Age: '.$row->age.'</span>'.'<span class="col-md-4">Father\'s Name: '.$row->father_name.'</span></div></a></li>
                ';
            }
            $output .= '</ul>';
        }

        echo $output;


    }

    public function searchMedicine(Request $request)
    {
        $ref = str_replace(' ','_',$request->key);

        $clinic_id = $request->clinic_id;

        $timestamp = Carbon::now();
        $current_date = $timestamp->format('y-m-d');

        $row_id = $request->rowid;

        $data = Pharmacy::select('id','name','code')->
                where('Ref', 'like', '%'.$ref.'%')->
                where('clinic_id',$clinic_id)->
                where('quantity','>','0')->
                where('expire_date', '>',$current_date)->
                where('status',1)->
                get();

        if(count($data) == 0)
        {
            $output = '';
        }else{  
            $output = '<ul class="list-group" style="display:block; position:relative;">';

            foreach($data as $row)
            {
                $output .= '
                    <li class="list-group-item" id="item_options" data-id ='.$row->id.' row-id='.$row_id.' onclick="s_option(this)" style="background-color:#f3f3f3;cursor:pointer;"><span>Name: '.$row->name.'</span><span class="float-right">Code: '.$row->code.'</span></li>
                ';
            }
            $output .= '</ul>';
        }

        echo $output;

    }

}
