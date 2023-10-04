<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\UserRegisterRequest;
use Auth;

use App\Models\Clinic;
use App\Models\User;
use App\Models\PackagePurchase;
use App\Models\UserClinic;
use App\Models\Patient;
use App\Models\Role;
use App\Models\Master;
use App\Models\Package;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Controllers\HomeController;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;

use Carbon\Carbon;

use Session;

use DB;

use Response;



// require_once 'phpseclib/Crypt/RSA.php';


class ClinicController extends Controller
{

    public function dashboard()
    {
        return view('clinic.dashboard');
    }

    public function index(Request $request)
    {
        if (Auth::user()->role_id != null) {

            $role = Role::where('id', Auth::guard('user')->user()['role_id'])->get()->first();


            try {
                $clinic_id = Crypt::decrypt($request->code);
                $clinic_name = Clinic::where('id', $clinic_id)->value('name');

                session()->put('cc_id', $clinic_id);
                session()->put('cc_name', $clinic_name);
            } catch (DecryptException $e) {
                abort(404);
            }

            $clinic_code = Clinic::where('id', $clinic_id)->pluck('code');
            $clinic_name = Clinic::where('id', $clinic_id)->value('name');
            $user_id = Auth::guard('user')->user()['id'];
            $available_doctors = DB::table('user')->select('role_id')->join('role', 'role.id', '=', 'user.role_id')->join('user_clinic', 'user_clinic.user_id', '=', 'user.id')->where('role.role_type', '1')->where('user_clinic.clinic_id', $clinic_id)->count();
            $now = new Carbon;

            if ($role->role_type == 2 || $role->role_type == 5) {

                $patientData = Patient::where('clinic_code', $clinic_id)
                    ->where('user_id', $user_id)
                    ->where('p_status', 1)
                    ->where('updated_at', '>=', $now->format('ymd'))
                    ->where('status', 1)
                    ->orderBy('updated_at', 'desc')->get();
            } elseif ($role->role_type == 1 || $role->role_type == 5) {


                $patientData = DB::table('patient')->select('*')->join('patient_doctor', 'patient_doctor.patient_id', '=', 'patient.id')->where('patient_doctor.user_id', Auth::user()->id)
                    ->where('patient.updated_at', '>=', $now->format('ymd'))
                    ->where('patient.p_status', 2)
                    ->where('patient.status', 1)
                    ->groupBy()
                    ->orderBy('patient.updated_at', 'desc')
                    ->get();
            } elseif ($role->role_type == 3 || $role->role_type == 5) {

                $patientData = Patient::where('clinic_code', $clinic_id)
                    ->where('p_status', 3)
                    ->where('updated_at', '>=', $now->format('ymd'))
                    ->where('status', 1)
                    ->orderBy('updated_at', 'desc')->get();
            } else {
                $patientData = "";
            }
            return view('user/clinic')->with('data', ['patientData' => $patientData, 'role' => $role->role_type, 'a_doctors' => $available_doctors, 'name' => $clinic_name]);
        } else {

            return view('user/clinic')->with('data', ['patientData' => 0, 'name' => $clinic_name]);
        }
    }

    public function register(Request $request)
    {

        $user_id = Auth::guard('user')->user()['id'];
        $clinic = new Clinic();
        $package = Package::find($request->package_id);

        if ($package->type == 'ultimate') {

            $permissions = [
                "p_view", "p_create", "p_update", "p_delete", "p_treatment",
                "d_view", "d_create", "d_update", "d_delete",
                "ph_view", "ph_create", "ph_update", "ph_delete",
                "pos_view", "pos_create", "pos_update", "pos_delete",
                "user_view", "user_create", "user_update", "user_delete"
            ];
        } else if ($package->type == 'group') {

            $permissions = [
                "p_view", "p_create", "p_update", "p_delete", "p_treatment",
                "d_view", "d_create", "d_update", "d_delete",
                "ph_view", "ph_create", "ph_update", "ph_delete",
                "pos_view", "pos_create", "pos_update", "pos_delete",
                "user_view", "user_update", "user_delete"
            ];
        } else if ($package->type == 'single') {

            $permissions = [
                "p_view", "p_create", "p_update", "p_delete", "p_treatment",
                "d_view", "d_create", "d_update", "d_delete",
                "ph_view", "ph_create", "ph_update", "ph_delete",
                "pos_view", "pos_create", "pos_update", "pos_delete",
            ];
        }

        $role_id = Role::create(['role_type' => '5', 'permissions' => json_encode($permissions)])->id;

        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            $filename = date('YmdHi') . '-' . $file->getClientOriginalName();
            $file->move(public_path('images/clinic-logos'), $filename);
        } else {
            $filename = NULL;
        }

        $clinic_id = $clinic->create([
            'code' => $request->clinic_name . '-' . $this->generateClinicCode(),
            'avatar' => $filename,
            'name' => $request->clinic_name,
            'email' => Auth::user()->email,
            'phoneNumber' => $request->phoneNumber,
            'package_id' => $request->package_id,
            'address' => $request->address,
            'package_purchased_data' => Carbon::now(),
        ])->id;

        $now = Carbon::now()->format('Y-m-d');

        PackagePurchase::create([
            'user_id' => $user_id,
            'clinic_id' => $clinic_id,
            'price' => $package['price'],
            'expire_at' => Carbon::parse($now)->addDays($package->trialPeriod),
            'status' => 1
        ]);


        Transaction::create([
            'guid' => Str::uuid(),
            'user_id' => Auth::guard('user')->user()['id'],
            'package_id' => $package->id,
            'cost_amount' => $package->price,
            'discount' => $package->discount,
            'on_trial' => '1',
            'created_at' => Carbon::now(),

        ]);

        UserClinic::create([
            'user_id' => $user_id,
            'clinic_id' => $clinic_id,
        ]);

        User::where('id', $user_id)->update(['user_type' => '3', 'role_id' => $role_id]); // (user-type) 1 = normal-user 2 = added_from_clinic 3 = own_clinic


        return redirect('/home');
    }

    public function completeDingerPayment()
    {


        $now = new Carbon;

        $clinic = Clinic::find(session()->get('clinic_id'));

        $package = Package::find($clinic->package_id);

        $clinic_user = UserClinic::where('clinic_id', $clinic->id)->where('user_id', Auth::id())->first();

        $user = User::find($clinic_user->user_id);

        Transaction::where('user_id',$clinic_user->user_id)->where('package_id',$clinic->package_id)->update([
            'cost_amount' => $package->price,
            'discount' => $package->discount,
            'on_trial' => '0',
            'updated_at' => Carbon::now(),
        ]);

        PackagePurchase::where('user_id',$clinic_user->user_id)->where('clinic_id',$clinic->id)->update([
            'price' => $package->price,
            'expire_at' => Carbon::parse($now)->addMonth(),
            'status' => 1
        ]);

        $user_clinic = UserClinic::where('user_id', $clinic->user_id)->with('expire')->with('clinic')->get();
        
        return view('user/home')->with('data',['user_clinic' => $user_clinic, 'clinic' => '1' , 'home_page' => '1']);
        

    }

    public function completePayment($id)
    {

        $clinic = Clinic::find(Crypt::decrypt($id));

        $package = Package::find($clinic->package_id);

        $clinic_user = UserClinic::where('clinic_id', $clinic->id)->where('user_id', Auth::id())->first();

        $user = User::find($clinic_user->user_id);

        session()->put('clinic_id', $clinic->id);

        $items_data = array(
            "name" => $user->name,
            "amount" => $package->price,
            "quantity" => "1"
        );


        $data_pay = json_encode(array(
            "clientId" => "bf0a61c0-2c64-3fe3-bea4-4904b2396685",
            "publicKey" => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCrnOykA9qFBy6h3OV9ZIJluF2zTWQoNDW2L7ZcYGfw+qBJYGKsZVyTD9eCuJJIFEQY6ztlOzp0OYxfGP4IAxy6KU94m7xdZRr1oIMcHWb1TRyKF1hy9tqbm9AY/hG2+wH8S/BUU1RZN1ZgphlADWMslS5kYIu9QbIZMQJvEB6hEwIDAQAB",
            "items" => json_encode(array($items_data)),
            "customerName" => $user->name,
            "totalAmount" => $package->price,
            "merchantOrderId" => Str::uuid(),
            "merchantKey" => "s65cfbn.bdg8yh5i04X--occ_JoAkry_ocM",
            "projectName" => "AungMyin",
            "merchantName" => "Kyaw Soe"
        ));


        $publicKey = 'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCFD4IL1suUt/TsJu6zScnvsEdLPuACgBdjX82QQf8NQlFHu2v/84dztaJEyljv3TGPuEgUftpC9OEOuEG29z7z1uOw7c9T/luRhgRrkH7AwOj4U1+eK3T1R+8LVYATtPCkqAAiomkTU+aC5Y2vfMInZMgjX0DdKMctUur8tQtvkwIDAQAB';

        $rsa = new \phpseclib\Crypt\RSA();

        extract($rsa->createKey(1024));
        $rsa->loadKey($publicKey); // public key
        $rsa->setEncryptionMode(2);
        $ciphertext = $rsa->encrypt($data_pay);
        $value = base64_encode($ciphertext);

        $urlencode_value = urlencode($value);

        $encryptedHashValue = hash_hmac('sha256', $data_pay, '130fb2878f107a57d8dfb637d4cb7d53');

        $redirect_url = "https://form.dinger.asia/?hashValue=$encryptedHashValue&payload=$urlencode_value";

        return redirect()->intended($redirect_url);
    }

    public function updateClinic(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phoneNumber' => 'required',
            'address' => 'required',
        ]);

        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            $filename = date('YmdHi') . '-' . $file->getClientOriginalName();
            $file->move(public_path('images/clinic-logos'), $filename);
        } else {
            $filename = Clinic::where('id', $id)->value('avatar');
        }

        Clinic::whereId($id)->update([
            'name' => $request->name,
            'phoneNumber' => $request->phoneNumber,
            'address' => $request->address,
            'avatar' => $filename,
        ]);

        $clinic = Clinic::where('id', $id)->first();

        return response()->json($clinic);
    }

    public function getLogo($clinicId)
    {
        $clinic = Clinic::findOrFail($clinicId);

        return response()->json(['logo' => $clinic->avatar]);
    }

    public function newUser()
    {

        if (!$this->checkPermission("user_create")) {
            abort(404);
        }

        $id = Clinic::where('id', session()->get('cc_id'))->pluck('package_id')->first();

        $data = ['1' => 'doctor', '2' => 'receptionist', '3' => 'pharmacist', '4' => 'staff'];

        return view('user/new')->with('data', $data);
    }

    public function registerUser(UserRegisterRequest $request)
    {

        if (!$this->checkPermission("user_create")) {
            abort(404);
        }

        $permissions = json_encode($request->permission);

        $role_id = Role::create(['role_type' => $request->role_type, 'permissions' => $permissions])->id;

        $clinic_id = session()->get('cc_id');

        $user = new User();

        $user_id = $user->create([

            'name' => $request->first_name . ' ' . $request->last_name,
            'role_id' => $role_id,
            'speciality' => $request->speciality,
            'credentials' => $request->credentials,
            'code' => $request->code,
            'email' => $request->email,
            'password' => $request->password,
            'phoneNumber' => $request->phoneNumber,
            'city' => $request->city,
            'country' => $request->country,
            'address' => $request->address,
            'short_bio' => $request->short_bio,
            'fees' => $request->fees,
            'user_type' => 2, // (user-type) 1 = normal-user 2 = added_from_clinic 3 = own_clinic
            'gender' => $request->gender,
            'email_verified' => '1',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,

        ])->id;

        UserClinic::create([
            'user_id' => $user_id,
            'clinic_id' => $clinic_id,
        ]);

        return Response::json('1');
    }

    public function editUser($id)
    {

        if (!$this->checkPermission("user_update")) {
            abort(404);
        }

        $user = User::findOrfail(Crypt::decrypt($id));
        $data = ['1' => 'doctor', '2' => 'receptionist', '3' => 'pharmacist', '4' => 'staff'];

        $role = Role::where('id', $user->role_id)->get()->first();
        return view('user/edit', compact('user', 'data', 'role'));
    }

    public function updateUser(UserUpdateRequest $request, $id)
    {
        if (!$this->checkPermission("user_update")) {
            abort(404);
        }

        $role = Role::where('id', Auth::guard('user')->user()['role_id'])->get()->first();

        $permissions = json_encode($request->permission);
        $origin_password = User::where('id', $id)->pluck('password');
        $role_id = User::where('id', $id)->pluck('role_id');

        if($request->role_type){
            $role_type = $request->role_type;
        }else{
            $role_type = 5;
        }

        $role_id = Role::where('id', $role_id)->update(['role_type' => $role_type, 'permissions' => $permissions]);

        $requests = [
            'name' => $request->first_name . ' ' . $request->last_name,
            'code' => $request->code,
            'speciality' => $request->speciality,
            'credentials' => $request->credentials,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'city' => $request->city,
            'country' => $request->country,
            'address' => $request->address,
            'gender' => $request->gender,
            'short_bio' => $request->short_bio,
            'fees' => $request->fees,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,

        ];

        if ($request->password != null && trim($request->password) != '') {
            $requests += ['password' => Hash::make($request->password)];
        }

        User::whereId($id)->update($requests);

        return redirect('clinic-system/users')->with('success', 'User updated successfully!');
    }

    public function deleteUser($id)
    {
        if (!$this->checkPermission("user_delete")) {
            abort(404);
        }

        User::whereId($id)->update(['status' => '0', 'deleted_at' => Carbon::now()]);

        return redirect('clinic-system/users')->with('success', 'User deleted successfully!');
    }


    public function stepOneRegister()
    {

        $user_id = Auth::id();

        $data = Package::where('status', 1)->orderBy('price', 'asc')->get();

        $clinic_data = UserClinic::where('user_id', $user_id)->count();

        if ($clinic_data > 2) {
            abort(404);
        } else {

            return view('registration/clinic_name')->with('data', $data);
        }
    }

    public function stepTwoRegister(Request $request)
    {
        try {
            $package_id = Crypt::decrypt($request->_token);
        } catch (DecryptException $e) {
            abort(404);
        }

        $free_month = $request->value;

        session()->put('is_free', $free_month);

        $payments = ['1_k' => 'kpay', '2_w' => 'wpay', '3_c' => 'cod'];

        return view('registration/clinic_registration')->with('data', ['package_id' => $package_id, 'payment_types' => $payments, 'free_month' => $free_month]);
    }

    public function generateClinicCode($count = 7)
    {
        $code = Str::random($count);

        return $code;
    }

    public function fetchDoctors()
    {

        if (session()->has('cc_id')) {
            $available_doctors = DB::table('user')->select('*')->join('role', 'role.id', '=', 'user.role_id')->join('user_clinic', 'user_clinic.user_id', '=', 'user.id')->where('role.role_type', '1')->where('user_clinic.clinic_id', session()->get('cc_id'))->get();

            if (count($available_doctors) > 0) {
                foreach ($available_doctors as $d) {
                    $data[] = [
                        'id' => $d->user_id, 'name' => $d->name,
                        'speciality' => $d->speciality
                    ];
                }
                return Response::json($data);
            }
        } else {
            return Response::json('no-session');
        }
    }

    public function waitingList(Request $request)
    {
        if (Auth::user()->role_id != null) {

            $role = Role::where('id', Auth::guard('user')->user()['role_id'])->get()->first();

            try {
                $clinic_id = Crypt::decrypt($request->code);
                $clinic_name = Clinic::where('id', $clinic_id)->value('name');

                $clinic_code = Clinic::where('id', $clinic_id)->pluck('code');
                $clinic_name = Clinic::where('id', $clinic_id)->value('name');
                $user_id = Auth::guard('user')->user()['id'];
                $available_doctors = DB::table('user')->select('role_id')->join('role', 'role.id', '=', 'user.role_id')->join('user_clinic', 'user_clinic.user_id', '=', 'user.id')->where('role.role_type', '1')->where('user_clinic.clinic_id', $clinic_id)->count();
                $now = new Carbon;

                if ($role->role_type == 2) {

                    $patientData = Patient::where('clinic_code', $clinic_id)
                        ->where('user_id', $user_id)
                        ->where('p_status', 1)
                        ->where('updated_at', '>=', $now->format('ymd'))
                        ->where('status', 1)
                        ->orderBy('updated_at', 'asc')->get();
                } elseif ($role->role_type == 1 || $role->role_type == 5) {

                    $patientData = DB::table('patient')->select('*')->join('patient_doctor', 'patient_doctor.patient_id', '=', 'patient.id')->where('patient_doctor.user_id', Auth::user()->id)
                        ->where('patient.updated_at', '>=', $now->format('ymd'))
                        ->where('patient.p_status', 2)
                        ->where('patient.status', 1)
                        ->where('patient.clinic_code', $clinic_id)
                        ->groupBy()
                        ->orderBy('patient.updated_at', 'asc')
                        ->get();
                } elseif ($role->role_type == 3 || $role->role_type == 5) {

                    $patientData = Patient::where('clinic_code', $clinic_id)
                        ->where('p_status', 3)
                        ->where('updated_at', '>=', $now->format('ymd'))
                        ->where('status', 1)
                        ->orderBy('updated_at', 'asc')->get();
                } else {
                    $patientData = array();
                }

                $output = '';
                $i = 1;
                if (count($patientData) > 0) {
                    $output .= '<table id="dat" class="table table-bordered table-striped">' .
                        '<thead>' .
                        '<tr>' .
                        '<th>#</th>' .
                        '<th>Name</th>' .
                        '<th>Age</th>' .
                        '<th>Father\'s name</th>' .
                        '<th colspan="3" style="width:15%;">Actions</th>' .
                        '</tr>' .
                        '</thead><tbody>';

                    foreach ($patientData as $row) {
                        $date = \Carbon\Carbon::parse($row->updated_at)->diffForHumans();

                        $output .= '<tr id="patient_row_' . $row->id . '">' .
                            '<td>' . $i++ .
                            '<td>' . $row->name . '&nbsp;&nbsp;&nbsp;';

                        if ($row->gender == 1) {
                            $output .= '<i class="fas fa-male fa-lg" style="color:blue;"></i>';
                        } else {
                            $output .= '<i class="fas fa-female fa-lg" style="color:rgb(251, 123, 145);"></i>';
                        }


                        $output .= '</td>';

                        $output .= '<td>' . $row->age . '</td>';
                        $output .= '<td>' . $row->father_name . '</td>';
                        $output .= '<td>';
                        $output .= '<div class="card-tools">';

                        if ($role->role_type == 1) {

                            $output .= '<a href="' . route('patient.edit',  Crypt::encrypt($row->patient_id)) . '" class="btn btn-sm btn-tool">
                                                <i class="fas fa-edit fa-lg" style="color:black;"></i>
                                            </a>';
                        }

                        if ($role->role_type == 2 || $role->role_type == 5) {

                            $output .= '<a href="' . route('patient.edit',  Crypt::encrypt($row->id)) . '" class="btn btn-sm btn-tool">
                                                <i class="fas fa-edit fa-lg" style="color:black;"></i>
                                            </a>';
                        }


                        if ($role->role_type == 2) {

                            $output .= '<a href="#" class="btn btn-sm btn-tool" onclick="assignTo(this)" id="status" data-status="2" data-patient-id = ' . $row->id . '>
                                                <i class="fas fa-stethoscope fa-lg" style="color:blue;"></i>
                                            </a>
                                            <div class="modal fade" id="myModal" role="dialog">
                                                <div class="modal-dialog">
                                    
                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <p class="text-left">Doctors</p>
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <table class="table table-bordered" id="data">
                                                            <tr>
                                                                <td>Name</td>
                                                                <td>Speciality</td>
                                                                <td>Action</td>
                                                            </tr>
                                                            <tr>
                                                            
                                                            </tr>
                                                    </table>
                                                    </div>
                                                
                                                    </div>
                                                    
                                                </div>
                                            </div>';
                        } elseif ($role->role_type == 1 || $role->role_type == 5) {

                            $output .= '<a href="' . route('patient.treatment', Crypt::encrypt($row->patient_id)) . '" style="margin:10px;"
                                                ><i class="fas fa-stethoscope fa-lg"></i>
                                                </a>';
                        } elseif ($role->role_type == 3 || $role->role_type == 5) {

                            $output .= '<a href="' . route('pos-patient', Crypt::encrypt($row->id)) . '" style="margin:10px;"
                                                ><i class="fas fa-receipt fa-lg"></i>
                                            </a>';
                        }

                        if ($role->role_type == 2) {

                            $output .= '<a href="#" class="btn btn-sm btn-tool" onclick="updateStatus(this)" id="status" data-status="5" data-patient-id = ' . $row->id . '>
                                                <i class="fas fa-trash fa-lg" style="color:rgb(239, 6, 6);"></i>
                                            </a>';
                        }
                        $output .= '</div>';
                        $output .= '</td>';
                        $output .= '</tr>';
                    }
                    $output .= '</tbody></table>';
                } else {
                    $output .= '<p class="text-center">No patient in waiting list.</p>';
                }

                echo $output;
            } catch (DecryptException $e) {
                abort(404);
            }
        }
    }

    private function userCodeGenerator()
    {
        $timestamp = Carbon::now();
        $current_date = $timestamp->format('u');
        $clinic_id = session()->get('cc_id');

        $c_name = Clinic::select('name')->where('id', $clinic_id)->first();

        $patient_code = str_replace(' ', '', $c_name->name) . ":u:" . $current_date;

        return $patient_code;
    }
}
