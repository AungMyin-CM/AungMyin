<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use App\Models\Dictionary;
use App\Models\Clinic;
use App\Models\Visit;
use App\Models\Role;
use App\Models\UserClinic;

use Carbon\Carbon;

use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;

use File;

use Session;

class PatientController extends Controller
{
    public function index(Request $request)
    {

        if(!$this->checkPermission('p_view')){
            abort(403);
        }
        
        $clinic_id = session()->get('cc_id');

        if($request->name)
        {
            $patientData =  Patient::where("clinic_code",$clinic_id)->where('name', 'like', $request->name.'%')->where('status',1)->get();
        }else{
            $patientData = Patient::where("clinic_code",$clinic_id)->where('status',1)->get();
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

            $clinic_id = session()->get('cc_id');
            $user_id = Auth::guard('user')->user()['id'];

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
                          'clinic_code' => $clinic_id,
                          'drug_allergy' => $request->drug_allergy,
                          'summary' => $request->summary,
                          'p_status' => $p_status,
                          'Ref' => $reference
            ])->id;

            if($role->role_type == 1)
            {

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
                'fees' => $request->fees == null ? 0.00 : $request->fees,
                'is_foc' => $request->is_foc,
                'user_id' => $user_id,
                'investigation' => $request->investigation,
                'procedure' => $request->procedure,
                'is_followup' => $request->is_followup,
                'followup_date' => $request->followup_date
            ]);

            }

            return redirect('clinic-system/patient')->with('success', "Done!");
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
        $reference = str_replace(' ','_',$request->name)."_".$request->age."_".str_replace(' ','_',$request->father_name);

        Patient::whereId($id)->update([
                             'name' => $request->name,
                             'age' => $request->age,
                             'father_name' => $request->father_name,
                             'address' => $request->address,
                             'gender' => $request->gender,
                             'phoneNumber' => $request->phoneNumber,
                             'drug_allergy' => $request->drug_allergy,
                             'summary' => $request->summary,
                             'Ref' => $reference ]);

        return redirect('clinic-system/patient')->with('success', 'Done !');
    }

    public function treatment($id)
    {
        try {
            $id = Crypt::decrypt($id);
            $patient = Patient::findOrfail($id);
            $visit = Visit::where(['patient_id' => $id, 'status' => 1])->orderBy('updated_at','DESC')->get();
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
        Patient::whereId($id)->update(['p_status' => '3']);
        $assign_medicines = '';
        if($request->med_id){
            $count_product = count($request->med_id);
            for($x = 0; $x < $count_product; $x++) {
                $assign_medicines .= $request->med_id[$x].'^'. $request->med_qty[$x].'^'.$request->days[$x].'<br>';
            }
        }
      

        Visit::create([
            'patient_id' => $id,
            'prescription' => $request->prescription,
            'diag' => $request->diag,
            'assigned_medicines' =>  $assign_medicines,
            'images' => json_encode($images),
            'fees' => $request->fees,
            'is_foc' => $request->is_foc,
            'user_id' => $user_id,
            'investigation' => $request->investigation,      
            'procedure' => $request->procedure,
            'is_followup' => $request->is_followup,
            'followup_date' => $request->followup_date
        ]);

        return redirect('clinic-system/patient')->with('success', "Done!");
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Patient::whereId($id)->update(['status' => '0', 'deleted_at' => Carbon::now()]);

        return redirect('clinic-system/patient')->with('success', 'Done !');
    }

    public function fetchDictionary(Request $request)
    {
        $text = $request->key;

        $data = Dictionary::select('code','meaning')->where(['code' => $text, 'isMed' => '0'])->first();

        if($data == ''){
            echo '';
        }else{
            echo $data;
        }
    }

    public function fetchIsmedData(Request $request)
    {
        $text = $request->key;

        $data = Dictionary::select('code','meaning')->where(['code' => $text, 'isMed' => '1'])->first();

        if($data == ''){
            echo '';
        }else{
            echo $data;
        }
    }

    public function updatePatientStatus(Request $request)
    {
        $status = $request->status;
        $patient_id = $request->patient_id;
        $user_id = Auth::guard('user')->user()['id'];

        try{
        Patient::whereId($patient_id)->update(['p_status' => $status]);

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
        $clinic_id = session()->get('cc_id');

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
