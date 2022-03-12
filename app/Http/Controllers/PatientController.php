<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PatientRequest;
use App\Models\Patient;
use App\Models\Dictionary;
use App\Models\Clinic;

use Carbon\Carbon;

use Auth;

class PatientController extends Controller
{
    public function index()
    {
        $patientData = Patient::all();
        return view('patient/index')->with('data',$patientData);
    }


    public function create()
    {
        $code = $this->codeGenerator();
        return view('patient/new')->with('code',$code);
    }

    public function store(PatientRequest $request)
    {   
        if($request->validated()){
            $patient = new Patient();

            $code = $this->codeGenerator();

            $dict->create(['code' => $code,
                          'name' => $request->name,
                          'father_name' => $request->father_name,
                          'age' => $request->age,
                          
            ]);
            return redirect('patient')->with('success', "Done!");

        }
    }

    public function edit($id)
    {
        $patient = Patient::findOrFail($id);

        return view('patient/edit', compact('patient'));
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

    private function codeGenerator()
    {
        $timestamp = Carbon::now();
        $current_date = $timestamp->format('ymdhis');
        $clinic_id = Auth::guard('user')->user()['clinic_id'];

        $c_name = Clinic::select('name')->where('id',$clinic_id)->first();

        $patient_code = str_replace(' ','',$c_name->name).":p:".$current_date;

        return $patient_code;

    }
}
