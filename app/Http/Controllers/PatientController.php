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
use App\Models\Procedure;
use App\Models\Investigation;
use App\Models\PatientProcedure;
use App\Models\PatientDisease;
use App\Models\PatientDiagnosis;


use App\Models\Notification;
use App\Models\PatientDoctor;
use App\Events\NoticeEvent;
use App\Events\PatientChanged;
use App\Models\Package;
use Carbon\Carbon;

use Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Exception;

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
                ->orderBy('updated_at', 'desc')
                ->paginate(12);
        }

        if ($request->ajax()) {
            return view('partials/_patient-card')->with('data', $patientData);
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
            $reference = str_replace(' ', '_', $request->name) . "_" . $request->age . "_" . str_replace(' ', '_', $request->father_name) . str_replace(' ', '_', $code);
            $p_status = $role->role_type == 1 ? 4 : 1;

            $newPatient = $patient->create([
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
            ]);

            event(new PatientChanged($newPatient));

            $patient_id = $newPatient->id;

            return redirect()->route('patient.treatment', [Crypt::encrypt($patient_id)]);
        }
    }

    public function storePatient(PatientRequest $request)
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
            $reference = str_replace(' ', '_', $request->name) . "_" . $request->age . "_" . str_replace(' ', '_', $request->father_name) . str_replace(' ', '_', $code);
            $p_status = $role->role_type == 1 ? 4 : 1;

            $newPatient = $patient->create([
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
            ]);

            event(new PatientChanged($newPatient));

            $patient_id = $newPatient->id;
        }

        return response()->json($newPatient);
    }

    public function show(Request $request)
    {
        $clinic_id = $request->query('clinic_id');
        $ref = str_replace(' ', '_', $request->query('name'));
        
        $patient = Patient::select('id', 'name', 'age', 'father_name', 'drug_allergy')->where('Ref', 'like', '%' . $ref . '%')->where('clinic_code', $clinic_id)->where('status', 1)->first();

        $visits = Visit::where('patient_id', $patient->id)->get();

        return view('patient.show')
            ->with('patient', $patient)
            ->with('visits', $visits);
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

        $patient = (Patient::where('id', $id)->get())[0];
        event(new PatientChanged($patient));

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
        event(new PatientChanged($patient));

        return response()->json($patient);
    }

    public function treatment(Request $request, $id)
    {
        if (!$this->checkPermission('p_treatment')) {
            abort(404);
        }

        try {
            $id = Crypt::decrypt($id);
            $userId = auth()->id();
            $patient = Patient::findOrfail($id);
            $visit = Visit::where(['patient_id' => $id, 'status' => 1])->with('disease')->with('diagnosis')->orderBy('updated_at', 'DESC')->paginate(1);

            $dictionaries = Dictionary::where('user_id', $userId)->where('deleted_at', null)->get();
            $medicines = Pharmacy::where('clinic_id', session()->get('cc_id'))->where('deleted_at', null)->get();


            Notification::where('patient_id', $id)->update(['is_read' => 1]);

            if ($request->ajax()) {
                return view('partials/_visit-modal')
                    ->with('patient', $patient)
                    ->with('visit', $visit)
                    ->with('dictionaries', $dictionaries)
                    ->with('medicines', $medicines);
            }

            return view('patient/treatment')
                ->with('patient', $patient)
                ->with('visit', $visit)
                ->with('dictionaries', $dictionaries)
                ->with('medicines', $medicines);
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function fetchProcedureLabData()
    {
        if (!$this->checkPermission('p_treatment')) {
            abort(404);
        }

        $array = [];

        $clinic_id = session()->get('cc_id');

        $procedure = Procedure::where('clinic_id', $clinic_id)->get()->toArray();

        $invesigation = Investigation::where('clinic_id', $clinic_id)->get()->toArray();

        $data = array_merge($procedure, $invesigation);

        return $data;
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

        $visit_id = Visit::create([
            'patient_id' => $id,
            'sys_bp' => $request->sys_bp,
            'dia_bp' => $request->dia_bp,
            'pr' => $request->pr,
            'temp' => $request->temp,
            'spo2' => $request->sys_bp,
            'rbs' => $request->rbs,
            'prescription' => $request->prescription,
            'assigned_medicines' =>  $assign_medicines,
            'images' => json_encode($images),
            'fees' => $request->fees,
            'is_foc' => $request->is_foc,
            'user_id' => $user_id,
            'investigation' => $request->investigation,
            'procedure' => $request->procedure,
            'followup_date' => $request->followup_date ? $request->followup_date : null,
            'is_followup' => $request->followup_date ? '1' : null,
        ])->id;

        if ($request->diag) {
            PatientDiagnosis::create([
                'uuid' => Str::uuid(),
                'clinic' => session()->get('cc_id'),
                'user' => $user_id,
                'patient' => $id,
                'visit' => $visit_id,
                'diagnosis' => $request->diag,
            ]);
        }

        if ($request->disease) {
            PatientDisease::create([
                'uuid' => Str::uuid(),
                'clinic' => session()->get('cc_id'),
                'user' => $user_id,
                'patient' => $id,
                'visit_id' => $visit_id,
                'disease' => $request->disease,
            ]);
        }

        if ($request->pro_lab_data) {
            PatientProcedure::where('uuid', $request->pro_lab_data)->update([
                'is_pos' => 1,
                'visit_id' => $visit_id,
            ]);
        }

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

        $package_type = (Clinic::whereId(session()->get('cc_id'))->get())[0]
            ->package
            ->type;

        if ($action != 'no-action' && $package_type != 'single') {

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

    public function saveProLabData(Request $request, $id)
    {


        $assign_tasks = '';

        $count = count($request->name);
        for ($x = 0; $x < $count; $x++) {
            $assign_tasks .= $request->name[$x] . '^' . $request->quantity[$x] . '^' . $request->price[$x] . '<br>';
        }

        if ($request->uuid) {

            PatientProcedure::where('uuid', $request->uuid)->update([
                'patient_id' => $request->patient_id,
                'assigned_tasks' => $assign_tasks,
                'is_pos' => 0
            ]);

            echo "true";
        } else {

            $uuid = Str::uuid();

            try {

                PatientProcedure::create([
                    'uuid' => $uuid,
                    'patient_id' => $request->patient_id,
                    'assigned_tasks' => $assign_tasks,
                    'is_pos' => 0
                ]);

                echo 'true' . $uuid;
            } catch (Exception $e) {
                echo 'false';
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::find($id);

        if ($patient) {
            $patient->update(['status' => '0']);
            // Soft delete
            $patient->delete();

            event(new PatientChanged($patient));
        }

        return redirect('clinic-system/patient')->with('success', 'Patient removed successfully!');
    }

    public function fetchDictionary(Request $request)
    {
        $text = $request->key;
        $user_id = Auth::guard('user')->user()['id'];

        $data = Dictionary::select('code', 'meaning')->where(['code' => $text, 'isMed' => null, 'user_id' =>  $user_id])->first();

        if ($data == '') {
            echo 'no-data';
        } else {
            echo $data;
        }
    }

    public function fetchDiagnosis(Request $request)
    {
        $text = $request->key;
        $user_id = Auth::guard('user')->user()['id'];

        $data = PatientDiagnosis::select('diagnosis')->where('diagnosis', 'like', '%' . $text . '%')->where(['clinic' => session()->get('cc_id')])->get();

        if (count($data) == 0) {
            $output = '';
        } else {

            foreach ($data as $row) {
                $output = '
                <li class="list-group-item" style="position:absolute;top:38px;cursor:pointer;border-color:#003049;z-index:1;" data-name =' . $row->diagnosis . ' onclick="sp_option(this)">
                    <span>' . $row->diagnosis . '</span>
                </li>
                ';
            }

            echo $output;
        }
    }

    public function fetchDisease(Request $request)
    {
        $text = $request->key;
        $user_id = Auth::guard('user')->user()['id'];

        $data = PatientDisease::select('disease')->where('disease', 'like', '%' . $text . '%')->where(['clinic' => session()->get('cc_id')])->get();

        if (count($data) == 0) {
            $output = '';
        } else {

            foreach ($data as $row) {
                $output = '
                <li class="list-group-item" style="position:absolute;top:38px;cursor:pointer;border-color:#003049;z-index:1;" data-name =' . $row->disease . ' onclick="sd_option(this)">
                    <span>' . $row->disease . '</span>
                </li>
                ';
            }

            echo $output;
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
                        <li class="list-group-item" id="item_options" data-id =' . $row->id . '  data-name =' . $row->name . ' row-id=' . $row_id . ' onclick="s_option(this)" style="background-color:#f3f3f3;cursor:pointer;z-index:1;"><span>' . $row->name . '</span></li>';
                }
                $output .= '</ul>';
            }

            echo $output;
        } else {
            echo $data;
        }
    }

    public function fetchProLab(Request $request)
    {

        if (!$this->checkPermission('p_treatment')) {
            abort(404);
        }


        $text = $request->key;

        $clinic_id = $request->id;


        $data = Procedure::where(['code' => $text, 'clinic_id' => $clinic_id])->first();

        if ($data == null) {
            $data = Investigation::where(['code' => $text, 'clinic_id' => $clinic_id])->first();
        }

        echo json_encode($data);
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

        $package_type = (Clinic::whereId(session()->get('cc_id'))->get())[0]
            ->package
            ->type;

        if ($action != 'no-action' && $package_type != 'single') {

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
            Patient::whereId(Crypt::decrypt($id))->update(['p_status' => '1', 'user_id' => $user_id]);

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
            return response()->json('updated');
        } catch (QueryException $e) {
            return response()->json('false');
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
