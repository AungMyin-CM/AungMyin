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
use App\Models\Pharmacy;
use App\Models\Notification;
use App\Models\PatientDoctor;
use App\Events\NoticeEvent;
use Carbon\Carbon;

use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;

use File;

use DB;

use Session;

class PatientController extends Controller
{
    public function index(Request $request)
    {

        if (!$this->checkPermission('p_view')) {
            abort(404);
        }

        $clinic_id = session()->get('cc_id');

        if ($request->name) {
            $patientData =  Patient::where("clinic_code", $clinic_id)->where('name', 'like', $request->name . '%')->where('status', 1)->get();
        } else {
            $patientData = Patient::where("clinic_code", $clinic_id)
                        ->where('status', 1)
                        ->orderBy('updated_at','desc')
                        ->paginate(12);
        }
        return view('patient/index')->with('data', $patientData);
    }


    public function create(Request $request)
    {
        if (!$this->checkPermission('p_create')) {
            abort(404);
        }

        $code = $this->codeGenerator();
        return view('patient/new')->with('data', ['code' => $code, 'name' => $request->name ? $request->name : '']);
    }

    public function store(PatientRequest $request)
    {
        if (!$this->checkPermission('p_create')) {
            abort(404);
        }

        if ($request->validated()) {
            $patient = new Patient();

            $code = $this->codeGenerator();

            $clinic_id = session()->get('cc_id');
            $user_id = Auth::guard('user')->user()['id'];

            $role = Role::where('id', Auth::guard('user')->user()['role_id'])->get()->first();
            $reference = str_replace(' ', '_', $request->name) . "_" . $request->age . "_" . str_replace(' ', '_', $request->father_name).str_replace(' ','_',$code);
            $p_status = $role->role_type == 1 ? 4 : 1;
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

            if ($role->role_type == 1) {

                $images = [];

                if ($request->hasfile('images')) {
                    foreach ($request->file('images') as $file) {
                        $name = $this->imageNameGenerate($patient_id) . '.' . $file->extension();
                        $path = public_path() . '/images/' . $code;
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
            return redirect()->route('user.clinic', [Crypt::encrypt($clinic_id)])->with('success', "Patient Created Successfully!");
        }
    }

    public function edit($id)
    {
        if (!$this->checkPermission('p_update')) {
            abort(404);
        }

        try {
            $id = Crypt::decrypt($id);
            $patient = Patient::findOrfail($id);
            return view('patient/edit', compact('patient'));
        } catch (DecryptException $e) {
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
        if (!$this->checkPermission('p_update')) {
            abort(404);
        }

        $reference = str_replace(' ', '_', $request->name) . "_" . $request->age . "_" . str_replace(' ', '_', $request->father_name);

        Patient::whereId($id)->update([
            'name' => $request->name,
            'age' => $request->age,
            'father_name' => $request->father_name,
            'address' => $request->address,
            'gender' => $request->gender,
            'phoneNumber' => $request->phoneNumber,
            'drug_allergy' => $request->drug_allergy,
            'summary' => $request->summary,
            'Ref' => $reference
        ]);

        return redirect('clinic-system/patient')->with('success', 'Patient updated successfully!');
    }

    public function updatePatient(PatientRequest $request, $id)
    {
        if (!$this->checkPermission('p_update')) {
            abort(404);
        }

        $reference = str_replace(' ', '_', $request->name) . "_" . $request->age . "_" . str_replace(' ', '_', $request->father_name);

        Patient::whereId($id)->update([
            'name' => $request->name,
            'age' => $request->age,
            'father_name' => $request->father_name,
            'address' => $request->address,
            'gender' => $request->gender,
            'phoneNumber' => $request->phoneNumber,
            'drug_allergy' => $request->drug_allergy,
            'summary' => $request->summary,
            'Ref' => $reference
        ]);

        // Get updated data
        $patient = (Patient::where('id', $id)->get())[0];

        return response()->json($patient);
    }

    public function treatment($id)
    {
        if (!$this->checkPermission('p_treatment')) {
            abort(404);
        }

        try {
            $id = Crypt::decrypt($id);
            $patient = Patient::findOrfail($id);
            $visit = Visit::where(['patient_id' => $id, 'status' => 1])->orderBy('updated_at', 'DESC')->get();

            Notification::where('patient_id', $id)->update(['is_read' => 1]);


            return view('patient/treatment')->with('data', ['patient' => $patient, 'visit' => $visit]);
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function saveTreatment(Request $request, $id)
    {

        if (!$this->checkPermission('p_treatment')) {
            abort(404);
        }

        $user_id = Auth::guard('user')->user()['id'];
        $code = $request->code;

        $images = [];

        $receiver_ids = DB::table('user')->select('*')->join('role', 'role.id', '=', 'user.role_id')->join('user_clinic', 'user_clinic.user_id', '=', 'user.id')->where('role.role_type', '3')->where('user_clinic.clinic_id', session()->get('cc_id'))->get();

        if ($request->hasfile('images')) {
            foreach ($request->file('images') as $file) {
                $name = $this->imageNameGenerate($id) . '.' . $file->extension();
                $path = public_path('images/treatment-images');
                $file->move($path, $name);
                $images[] = $name;
            }
        }
        Patient::whereId($id)->update(['p_status' => '3']);
        $assign_medicines = '';
        if ($request->med_id) {
            //   dd($request);
            $count_product = count($request->med_id);
            for ($x = 0; $x < $count_product; $x++) {
                $med = $request->med_id[$x] == null ? $request->med_name[$x] : $request->med_id[$x];
                $assign_medicines .= $med . '^' . $request->quantity[$x] . '^' . $request->days[$x] . '<br>';
            }
        }


        Visit::create([
            'patient_id' => $id,
            'sys_bp' => $request->sys_bp,
            'dia_bp' => $request->dia_bp,
            'pr' => $request->pr,
            'temp' => $request->temp,
            'spo2' => $request->sys_bp,
            'rbs' => $request->rbs,

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


        switch ('3') {
            case '1':
                $action = 'waiting';
                break;
            case '2':
                $action = 'treatment';
                break;
            case '3':
                $action = 'pos';
                break;
            case '4':
                $action = 'completed';
                break;
            case '5':
                $action = 'no-action';
                break;

            default:
                $action = 'none';
                break;
        }

        if ($action != 'no-action') {

            $clinic_id = session()->get('cc_id');
            foreach ($receiver_ids as $rd) {

                Notification::create([
                    'sender_id' => $user_id,
                    'receiver_id' => $rd->user_id,
                    'clinic_id' => session()->get('cc_id'),
                    'patient_id' => $id,
                    'is_sent' => '1',
                    'action_on_sent' => $action
                ]);

                NoticeEvent::dispatch("New Patient Entry!!",  $clinic_id . "_" .  $rd->user_id);
            }
        }

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

        return redirect('clinic-system/patient')->with('success', 'Patient removed successfully!');
    }

    public function fetchDictionary(Request $request)
    {
        $text = $request->key;
        $user_id = Auth::guard('user')->user()['id'];

        $data = Dictionary::select('code', 'meaning')->where(['code' => $text, 'isMed' => '0', 'user_id' =>  $user_id])->first();

        if ($data == '') {
            echo '';
        } else {
            echo $data;
        }
    }

    public function fetchIsmedData(Request $request)
    {
        $text = $request->key;
        $user_id = Auth::guard('user')->user()['id'];

        $data = Dictionary::select('code', 'meaning')->where(['code' => $text, 'isMed' => '1', 'user_id' =>  $user_id])->first();

        if ($data == '') {
            $ref = str_replace(' ', '_', $request->key);

            $clinic_id = $request->clinic_id;

            $timestamp = Carbon::now();
            $current_date = $timestamp->format('y-m-d');

            $row_id = $request->rowid;

            $data = Pharmacy::select('id', 'name', 'code')->where('Ref', 'like', '%' . $ref . '%')->where('clinic_id', $clinic_id)->where('quantity', '>', '0')->where('expire_date', '>', $current_date)->where('status', 1)->get();

            if (count($data) == 0) {
                $output = '';
            } else {
                $output = '<ul class="list-group" style="display:block; position:relative;z-index:1;">';

                foreach ($data as $row) {
                    $output .= '
                        <li class="list-group-item" id="item_options" data-id =' . $row->id . '  data-name =' . $row->name . ' row-id=' . $row_id . ' onclick="s_option(this)" style="background-color:#f3f3f3;cursor:pointer;"><span>' . $row->name . '</span></li>';
                }
                $output .= '</ul>';
            }

            echo $output;
        } else {
            echo $data;
        }
    }

    public function updatePatientStatus(Request $request)
    {
        $status = $request->status;
        $patient_id = $request->patient_id;
        $user_id = Auth::guard('user')->user()['id'];
        $receiver_id = $request->receiver_id;
        Patient::whereId($patient_id)->update(['p_status' => $status]);

        switch ($status) {
            case '1':
                $action = 'waiting';
                break;
            case '2':
                $action = 'treatment';
                break;
            case '3':
                $action = 'pos';
                break;
            case '4':
                $action = 'completed';
                break;
            case '5':
                $action = 'no-action';
                break;

            default:
                $action = 'none';
                break;
        }

        if ($action != 'no-action') {

            if ($action == 'treatment') {

                $count = PatientDoctor::where('patient_id', $patient_id)->where('user_id', $receiver_id)->get()->count();

                if ($count == 0) {
                    PatientDoctor::create([
                        'patient_id' => $patient_id,
                        'user_id' => $receiver_id,
                        'status' => 0, // 0 => assign-to-doctor, 1 => in-progress-treatment, 2 => pharmacy-counter

                    ]);
                }
            }



            $clinic_id = session()->get('cc_id');

            NoticeEvent::dispatch("New Patient Entry!!",  $clinic_id . "_" . $receiver_id);
            Notification::create([
                'sender_id' => $user_id,
                'receiver_id' => $receiver_id,
                'clinic_id' => session()->get('cc_id'),
                'patient_id' => $patient_id,
                'is_sent' => '1',
                'action_on_sent' => $action,
            ]);
        }


        echo "changed";
    }

    public function addQueue($id)
    {
        $user_id = Auth::guard('user')->user()['id'];

        try {
            Patient::whereId($id)->update(['p_status' => '1', 'user_id' => $user_id]);

            $role = Role::where('id', Auth::guard('user')->user()['role_id'])->get()->first();

            $clinic_id = session()->get('cc_id');
            $now = new Carbon;


            if ($role->role_type == 2 || $role->role_type == 5) {

                $patientData = Patient::where('clinic_code', $clinic_id)
                    ->where('user_id', $user_id)
                    ->where('p_status', 1)
                    ->where('updated_at', '>=', $now->format('ymd'))
                    ->where('status', 1)->get();
            } elseif ($role->role_type == 1 || $role->role_type == 5) {

                $patientData = Patient::where('clinic_code', $clinic_id)
                    ->where('p_status', 2)->where('status', 1)
                    ->where('updated_at', '>=', $now->format('ymd'))
                    ->where('status', 1)->get();
            } elseif ($role->role_type == 3 || $role->role_type == 5) {

                $patientData = Patient::where('clinic_code', $clinic_id)
                    ->where('p_status', 3)->where('status', 1)
                    ->where('updated_at', '>=', $now->format('ymd'))
                    ->where('status', 1)->get();
            } else {
                $patientData = "";
            }
            return redirect()->route('user.clinic', Crypt::encrypt(session()->get('cc_id')));
        } catch (QueryException $e) {
            echo "false";
        }
    }

    public function copyTreatment(Request $request)
    {
        if (!$this->checkPermission('p_treatment')) {
            abort(404);
        }

        $id = $request->id;

        try {
            $data = Visit::whereId($id)->get()->first();
            return  $data;
        } catch (QueryException $e) {
            echo "false";
        }
    }

    public function removeTreatment(Request $request)
    {
        if (!$this->checkPermission('p_treatment')) {
            abort(404);
        }

        $id = $request->id;

        try {
            Visit::whereId($id)->update(['status' => '0', 'deleted_at' => Carbon::now()]);
            echo "updated";
        } catch (QueryException $e) {
            echo "false";
        }
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

    private function imageNameGenerate($patient_id)
    {
        $timestamp = Carbon::now();
        $current_date = $timestamp->format('ymdhisu');

        $image_name = "p-" . $patient_id . '-' . $current_date;

        return $image_name;
    }
    public  function patientImport(Request $request)
    {
        $importData = [];
        if ($request->hasfile('importFile')) {

            $file = $request->file('importFile');
            if (($open = fopen($file, "r")) !== FALSE) {

                while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
                    $importData[] = $data;
                }

                fclose($open);
            }

            $clinic_id = session()->get('cc_id');
            $user_id = Auth::guard('user')->user()['id'];
            if (count($importData) <= 1) {
                return redirect('clinic-system/patient')->with('error', 'Empty CSV');
            }

            for ($i = 1; $i < count($importData); $i++) {
                if (array_count_values($importData[$i]) < 8) {
                    return redirect('clinic-system/pharmacy')->with('error', 'Invalid CSV');
                }

                $patient = new Patient();

                $code = $this->codeGenerator();

                $clinic_id = session()->get('cc_id');
                $user_id = Auth::guard('user')->user()['id'];

                $role = Role::where('id', Auth::guard('user')->user()['role_id'])->get()->first();
                $reference = str_replace(' ', '_', $importData[$i][0]) . "_" . $importData[$i][2] . "_" . str_replace(' ', '_', $importData[$i][1]);
                $p_status = $role->role_type == 1 ? 4 : 1;
                $patient_id = $patient->create([
                    'user_id' => Auth::guard('user')->user()['id'],
                    'code' => $code,
                    'name' => $importData[$i][0],
                    'father_name' => $importData[$i][1],
                    'phoneNumber' => $importData[$i][3],
                    'age' => $importData[$i][2],
                    'address' => $importData[$i][4],
                    'gender' => $importData[$i][5],
                    'clinic_code' => $clinic_id,
                    'drug_allergy' => $importData[$i][7],
                    'summary' => $importData[$i][6],
                    'p_status' => $p_status,
                    'Ref' => $reference
                ])->id;
            }
            return redirect('clinic-system/patient')->with('success', 'Done !');
        }
    }
}
