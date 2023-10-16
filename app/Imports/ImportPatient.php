<?php

namespace App\Imports;

use App\Models\Patient;
use App\Models\Clinic;
use App\Models\Role;


use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\Importable;


use Carbon\Carbon;

use Auth;

class ImportPatient implements ToModel, WithValidation, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $user_id = Auth::guard('user')->user()['id'];

        if($row['gender'] == "Male"){
            $row['gender'] = 1 ;
        }else if($row['gender'] == "Female"){ 
            $row['gender'] = 0 ; 
        }

        $role = Role::where('id', Auth::guard('user')->user()['role_id'])->get()->first();

        $p_status = $role->role_type == 1 ? 4 : 1;

        $code = $this->codeGenerator();


        $reference = str_replace(' ', '_', $row['name']) . "_" . $row['age'] . "_" . str_replace(' ', '_', $row['father_name']) . str_replace(' ', '_', $code);


        return new Patient([

            "user_id"           => $user_id,
            "code"              => $code,
            "clinic_code"       => session()->get('cc_id'),
            "name"              => $row['name'] ,
            "father_name"       => $row['father_name'],
            "age"               => $row['age'],
            "phone_number"      => $row['phone_number'],
            "address"           => $row['address'],
            "gender"            => $row['gender'],
            "summary"           => $row['summary'],
            "drug_allergy"      => $row['drug_allergy'],
            "p_status"          => $p_status,
            "Ref"               => $reference
            

        ]);
    }

    public function rules(): array
    {
        return [
            'name'      => 'required',
            'age'          => 'required',
            'address'      => 'required',
            'gender'       => 'required'
        ];
    }

    private function codeGenerator()
    {
        $timestamp = Carbon::now();
        $current_date = $timestamp->format('u');
        $clinic_id = session()->get('cc_id');

        $c_name = Clinic::select('name')->where('id', $clinic_id)->first();

        $patient_code = str_replace(' ', '', $c_name->name) . ":p:" . $current_date;

        return $patient_code;
    }
}
