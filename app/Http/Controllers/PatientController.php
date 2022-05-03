<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use App\Models\Dictionary;
use App\Models\Clinic;
use App\Models\Visit;
use App\Models\Role;

use Carbon\Carbon;

use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;

use File;


class PatientController extends Controller
{
    public function index(Request $request)
    {

        if(!$this->checkPermission('p_view')){
            abort(403);
        }
        
        $clinic_id = Auth::guard('user')->user()['clinic_id'];

        $clinic_code = Clinic::where('id',$clinic_id)->pluck('code');

        if($request->name)
        {
            $patientData =  Patient::where("clinic_code",$clinic_code)->where('name', 'like', $request->name.'%')->where('status',1)->get();
        }else{
            $patientData = Patient::where("clinic_code",$clinic_code)->where('status',1)->get();
        }
        return view('patient/index')->with('data',$patientData);
    }


    public function create(Request $request)
    {
        $code = $this->codeGenerator();
        return view('patient/new')->with('data' , ['code' => $code , 'name' => $request->name ? $request->name : '']);

    }

    public function store(PatientRequest $request)
    {   
        if($request->validated()){
            $patient = new Patient();

            $code = $this->codeGenerator();

            $clinic_id = Auth::guard('user')->user()['clinic_id'];
            $user_id = Auth::guard('user')->user()['id'];

            $clinic_code = Clinic::select('code')->where('id',$clinic_id)->first();
            $role = Role::where('id', Auth::guard('user')->user()['role_id'])->get()->first();
            $reference = str_replace(' ','_',$request->name)."_".$request->age."_".str_replace(' ','_',$request->father_name);
            $p_status = $role->role_type == 1 ? 4 : 1 ;
            $patient_id = $patient->create([
                          'user_id' => Auth::guard('user')->user()['id'],
                          'code' => $code,
                          'name' => $request->name,
                          'father_name' => $request->father_name,
                          'phoneNumber' => $request->phoneNumber,
                          'age' => $request->age,
                          'address' => $request->address,
                          'gender' => $request->gender,
                          'clinic_code' => $clinic_code->code,
                          'drug_allergy' => $request->drug_allergy,
                          'summary' => $request->summary,
                          'p_status' => $p_status,
                          'Ref' => $reference
            ])->id;


            $images = [];

            if($request->hasfile('images'))
            {
                foreach($request->file('images') as $file)
                {
                    $name = $this->imageNameGenerate($patient_id).'.'.$file->extension();
                    $path = public_path().'/images/'.$code;
                    File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
                    $file->move($path, $name);  
                    $images[] = $name;  
                }
            }

            Visit::create([
                'patient_id' => $patient_id,
                'prescription' => $request->prescription,
                'diag' => $request->diag,
                'images' => json_encode($images),
                'fees' => $request->fees,
                'doctor_id' => $user_id,
                'investigation' => $request->investigation,
                'procedure' => $request->procedure,
                'is_followup' => $request->is_followup,
                'followup_date' => $request->followup_date
            ]);

            return redirect('patient')->with('success', "Done!");
        }
    }

    public function edit($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $patient = Patient::findOrfail($id);
            return view('patient/edit',compact('patient'));

        }catch(DecryptException $e){
            abort(404);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatientRequest $request, $id)
    {
        Patient::whereId($id)->update($request->validated());

        return redirect('patient')->with('success', 'Done !');
    }

    public function treatment($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $patient = Patient::findOrfail($id);
            $visit = Visit::where(['patient_id' => $id, 'status' => 1])->get();
            return view('patient/treatment')->with('data' , [ 'patient' => $patient , 'visit' => $visit]);

        }catch(DecryptException $e){
            abort(404);
        }
    }

    public function saveTreatment(Request $request, $id)
    {
        
        $user_id = Auth::guard('user')->user()['id'];
        $code = $request->code;

        $images = [];

        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $file)
            {
                $name = $this->imageNameGenerate($id).'.'.$file->extension();
                $path = public_path().'/images/'.$code;
                $file->move($path, $name);  
                $images[] = $name;  
            }
        }

        Visit::create([
            'patient_id' => $id,
            'prescription' => $request->prescription,
            'diag' => $request->diag,
            'images' => json_encode($images),
            'fees' => $request->fees,
            'doctor_id' => $user_id,
            'investigation' => $request->investigation,
            'procedure' => $request->procedure,
            'is_followup' => $request->is_followup,
            'followup_date' => $request->followup_date
        ]);

        return redirect('patient')->with('success', "Done!");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dict = Patient::findOrFail($id);
        $dict->delete();

        return redirect('patient')->with('success', 'Done !');
    }

    public function fetchDictionary(Request $request)
    {
        $text = $request->key;

        $data = Dictionary::select('code','meaning')->where('code',$text)->first();

        if($data == ''){
            echo '';
        }else{
            echo $data;
        }
    }

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
                <li class="list-group-item d-flex justify-content-between align-items-center"><a href="'.route('patient.treatment', Crypt::encrypt($row->id)).'">Name: '.$row->name.''.'<span style= "margin:0rem 5rem 0rem 5rem;">Age: '.$row->age.'</span>'.'Father\'s Name: '.$row->father_name.'</a></li>
                ';
            }
            $output .= '</ul>';
        }

        echo $output;

    }

    public function updatePatientStatus(Request $request)
    {
        $status = $request->status;
        $patient_id = $request->patient_id;
        $user_id = Auth::guard('user')->user()['id'];

        try{
        Patient::whereId($patient_id)->update(['p_status' => $status]);

        $role = Role::where('id', Auth::guard('user')->user()['role_id'])->get()->first();
        $clinic_code = Clinic::where('id' , Auth::guard('user')->user()['clinic_id'])->pluck('code');
        $user_id = Auth::guard('user')->user()['id'];
            echo "changed";
        }catch(QueryException $e){
            echo "false";
        }
    }

    private function codeGenerator()
    {
        $timestamp = Carbon::now();
        $current_date = $timestamp->format('u');
        $clinic_id = Auth::guard('user')->user()['clinic_id'];

        $c_name = Clinic::select('name')->where('id',$clinic_id)->first();

        $patient_code = str_replace(' ','',$c_name->name).":p:".$current_date;

        return $patient_code;

    }

    private function imageNameGenerate($patient_id)
    {
        $timestamp = Carbon::now();
        $current_date = $timestamp->format('ymdhisu');

        $image_name = "p-".$patient_id.'-'.$current_date;

        return $image_name;

    }
}
