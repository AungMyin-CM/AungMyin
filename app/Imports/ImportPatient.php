<?php

namespace App\Imports;

use App\Models\Patient;
use Maatwebsite\Excel\Concerns\ToModel;

use Auth;

class ImportPatient implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user_id = Auth::guard('user')->user()['id'];

        if      ($row["gender"] == "male")     $row["gender"] = 1 ;
        elseif  ($row["gender"] == "female")     $row["gender"] = 0 ;

        return new Patient([

            "name"              => $row['name'] ,
            "father_name"       => $row["father_name"],
            "age"               => $row["age"],
            "phone_number"      => $row["phone_number"],
            "address"           => $row["address"] ,
            "gender"            => $row["gender"] ,
            "summary"           => $row['summary'],
            "drug_allergy"      => $row['drug_allergy']
            

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
}
