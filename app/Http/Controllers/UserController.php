<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Models\Package;
use App\Models\PackagePurchase;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Role;
use App\Models\UserClinic;
use Illuminate\Support\Facades\Hash;

use Auth;



class UserController extends Controller
{
    public function index()
    {
        return view('registration/user');
    }

    public function userList()
    {

        if (!$this->checkPermission("user_view")) {
            abort(404);
        }

        $clinic_id = session()->get('cc_id');

        $user_id = UserClinic::where('clinic_id', $clinic_id)->pluck('user_id');


        $userData = User::whereIn('id', $user_id)
            ->where('status', '1')
            ->orderBy('id', 'desc')
            ->paginate(12);

        return view('user/index')->with('data', $userData);
    }

    public function register(UserRegisterRequest $request)
    {
        $user = new User();

        $filename = null;

        if ($request->file('avatar') != '') {
            $file = $request->file('avatar');
            $filename = date('YmdHi') . '-' . $file->getClientOriginalName();
            $file->move(public_path('images/avatars'), $filename);
        }

        // if ($request->title == 'Mr') {
        //     $gender = 1;
        // } else {
        //     $gender = 0;
        // }


         $user->where('email', $request->email)->update([
            'name' => $request->first_name.' '.$request->last_name,
            'avatar' => $filename,
            'password' => Hash::make($request->password),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
           
        ]);

        $user_id = User::where('email',$request->email)->value('id');

        Auth::loginUsingId($user_id);

        // $hash = $this->generateTokenVerify();
        // $token = $user_id . $hash;
        // $verifyURL = route('verify', ['token' => $hash, 'value' => $user_id, 'service' => 'Email_verification']);

        // $message = 'Dear <b>' . $request->name . '</b>';
        // $message = 'Thanks for singing up, we just need to verify your email address';
        // $mail_data = [
        //     'recipient' => $request->email,
        //     'fromEmail' => 'aungmyin.cm@gmail.com',
        //     'fromName' => 'Aung Myin Authentication',
        //     'subject' => 'Email Verification',
        //     'body' => $message,
        //     'actionLink' => $verifyURL,
        // ];
        // \Mail::send('email-template', $mail_data, function ($message) use ($mail_data) {
        //     $message->to($mail_data['recipient'])
        //         ->from($mail_data['fromEmail'], $mail_data['fromName'])
        //         ->subject($mail_data['subject']);
        // });

        echo 'complete-registration';

        // return redirect('/login')->with('success', 'You need to verify your account. We have sent you an activation link, please check your mail');
    }

    public function sendOtp(Request $request)
    {

        $user = new User();

        $otp = $this->otpGenerator();

        $user = User::where("email",$request->email)->count();

        if($user > 0)
        {
            $user_id = User::where('email',$request->email)->value('id');
            User::where('email',$request->email)->update(['otp' => $otp]);
           
        }else{

            $user_id = User::create([
                'email' => $request->email,
                'otp' => $otp
            ])->id;

        }

        $verifyURL = route('verify', ['otp' => $otp, 'value' => $user_id, 'service' => 'Email_verification']);

        $message = 'Hello, <b>' . $request->email . '</b>';
        $message = 'Thanks for singing up, we just need to verify your email address';
        $mail_data = [
            'recipient' => $request->email,
            'fromEmail' => 'aungmyin.cm@gmail.com',
            'fromName' => 'Aung Myin Authentication',
            'subject' => 'Email Verification',
            'body' => $message,
            'otp' => $otp,
        ];
        \Mail::send('email-template', $mail_data, function ($message) use ($mail_data) {
            $message->to($mail_data['recipient'])
                ->from($mail_data['fromEmail'], $mail_data['fromName'])
                ->subject($mail_data['subject']);
        });

        echo "Email Sent";


    }

    public function checkOtp(Request $request)
    {

        $otp = str_replace(',','',$request->otp);

        $email = $request->email;

        $value = User::where('email',$email)->where('otp',$otp)->count();

        if($value == 1)
        {
            User::where('email',$email)->update(['email_verified' => 1, 'email_verified_at' => Carbon::now()]);

            echo "valid";
        }else{
            echo "invalid";
        }


    }

    public function showMailTemp()
    {
        // $user = new User();

        // $user_id = $user->create([
        //    'email' => $request->email
        // ])->id;

        // $otp = $this->otpGenerator();

        $otp = $this->otpGenerator();

        $verifyURL = route('verify', ['otp' => $otp, 'value' => '1', 'service' => 'Email_verification']);

        $message = 'Hello, <b>' . 'email' . '</b>';
        $message = 'Thanks for singing up, we just need to verify your email address';
        $mail_data = [
            'recipient' => 'email@gmail.com',
            'fromEmail' => 'aungmyin.cm@gmail.com',
            'fromName' => 'Aung Myin Authentication',
            'subject' => 'Email Verification',
            'body' => $message,
            'otp' => $otp,
        ];
        // \Mail::send('email-template', $mail_data, function ($message) use ($mail_data) {
        //     $message->to($mail_data['recipient'])
        //         ->from($mail_data['fromEmail'], $mail_data['fromName'])
        //         ->subject($mail_data['subject']);
        // });

        return view('email-template',compact('otp'));
        
    }

    // public function sendOtp(Request $request)
    // {

    //     $user = new User();

    //     $otp = $this->otpGenerator();

    //     $user = User::where("email",$request->email)->count();

    //     if($user > 0)
    //     {
    //         $user_id = User::where('email',$request->email)->value('id');
    //         User::where('email',$request->email)->update(['otp' => $otp]);
           
    //     }else{

    //         $user_id = User::create([
    //             'email' => $request->email,
    //             'otp' => $otp
    //         ])->id;

    //     }

    //     $verifyURL = route('verify', ['otp' => $otp, 'value' => $user_id, 'service' => 'Email_verification']);

    //     $message = 'Hello, <b>' . $request->email . '</b>';
    //     $message = 'Thanks for singing up, we just need to verify your email address';
    //     $mail_data = [
    //         'recipient' => $request->email,
    //         'fromEmail' => 'aungmyin.cm@gmail.com',
    //         'fromName' => 'Aung Myin Authentication',
    //         'subject' => 'Email Verification',
    //         'body' => $message,
    //         'otp' => $otp,
    //     ];
    //     \Mail::send('email-template', $mail_data, function ($message) use ($mail_data) {
    //         $message->to($mail_data['recipient'])
    //             ->from($mail_data['fromEmail'], $mail_data['fromName'])
    //             ->subject($mail_data['subject']);
    //     });

    //     echo "Email Sent";


    // }

    // public function checkOtp(Request $request)
    // {

    //     $otp = str_replace(',','',$request->otp);

    //     $email = $request->email;

    //     $value = User::where('email',$email)->where('otp',$otp)->count();

    //     if($value == 1)
    //     {
    //         User::where('email',$email)->update(['email_verified' => 1, 'email_verified_at' => Carbon::now()]);

    //         echo "valid";
    //     }else{
    //         echo "invalid";
    //     }


    // }

    // public function showMailTemp()
    // {
    //     // $user = new User();

    //     // $user_id = $user->create([
    //     //    'email' => $request->email
    //     // ])->id;

    //     // $otp = $this->otpGenerator();

    //     $otp = $this->otpGenerator();

    //     $verifyURL = route('verify', ['otp' => $otp, 'value' => '1', 'service' => 'Email_verification']);

    //     $message = 'Hello, <b>' . 'email' . '</b>';
    //     $message = 'Thanks for singing up, we just need to verify your email address';
    //     $mail_data = [
    //         'recipient' => 'email@gmail.com',
    //         'fromEmail' => 'aungmyin.cm@gmail.com',
    //         'fromName' => 'Aung Myin Authentication',
    //         'subject' => 'Email Verification',
    //         'body' => $message,
    //         'otp' => $otp,
    //     ];
    //     // \Mail::send('email-template', $mail_data, function ($message) use ($mail_data) {
    //     //     $message->to($mail_data['recipient'])
    //     //         ->from($mail_data['fromEmail'], $mail_data['fromName'])
    //     //         ->subject($mail_data['subject']);
    //     // });

    //     return view('email-template',compact('otp'));
        
    // }

    public function generateTokenVerify()
    {
        $characters = 'MV4560GM678ZA0B0E1DABCDEFGHIJKLM';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
            $finalVerifynumber = 'AM' . $randomString;
        }
        return $finalVerifynumber;
    }

    public function otpGenerator()
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 4; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function verify(Request $request)
    {
        $user_id = $request->value;
        $verifyUser = User::where('id', $user_id)->first();
        if (!is_null($verifyUser)) {
            if (!$verifyUser->email_verified) {
                $verifyUser->email_verified = 1;
                $verifyUser->email_verified_at = Carbon::now()->toDateTimeString();
                $verifyUser->save();
                return redirect('/login')->with('success', 'Your email is verified successfully. You can now login')->with('verifiedEmail', $verifyUser->email);
                // return view('login')->with('verifiedEmail',$user->email);
            } else {
                return redirect('/login')->with('success', 'Your email already verified successfully. You can now login')->with('verifiedEmail', $verifyUser->email);
                // return 'Already Verified';
            }
        }
    }

    public function checkUsername(Request $request)
    {
        if ($request->get('username')) {
            $username = $request->get('username');
            $data = User::where('code', $username)
                ->count();
            if ($data > 0) {
                echo 'not_unique';
            } else {
                echo 'unique';
            }
        }
    }


    public function checkEmail(Request $request)
    {
        if ($request->get('email')) {
            $email = $request->get('email');
            $data = User::where('email', $email)->where('email_verified','1')
                ->count();
            if ($data > 0) {
                echo 'not_unique';
            } else {
                echo 'unique';
            }
        }
    }

    public function updateProfile($id)
    {
        $user = User::findOrfail($id);
        $data = ['1' => 'doctor', '2' => 'receptionist', '3' => 'pharmacist', '4' => 'staff'];

        // Get package info
        $package = PackagePurchase::where('user_id', $id)->first();

        $role = Role::where('id', $user->role_id)->get()->first();

        if (!is_null($package)) {
            // Get purchase date
            $purchase_date = strtotime($package->created_at);

            // Get days left
            $expire_date = strtotime($package->expire_at);
            $current_date = time();
            $diff = $expire_date - $current_date;
            $days_left = floor($diff / (60 * 60 * 24));


            return view('profile/update', compact('user', 'data', 'package', 'purchase_date', 'expire_date', 'days_left', 'role'));
        } else {
            return view('profile/update', compact('user', 'data', 'role'));
        }
    }

    public function saveProfile($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'password' => 'confirmed',
            'phoneNumber' => 'required'
        ]);

        if ($request->file('avatar') != '') {
            $file = $request->file('avatar');
            $filename = date('YmdHi') . '-' . $file->getClientOriginalName();
            $file->move(public_path('images/avatars'), $filename);
        } else {
            $filename = User::where('id', Auth::guard('user')->user()['id'])->value('avatar');
        }

        $requests = [
            'name' => $request->name,
            'speciality' => $request->speciality,
            'avatar' => $filename,
            'credentials' => $request->credentials,
            'name' => $request->name,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'city' => $request->city,
            'country' => $request->country,
            'address' => $request->address,
            'gender' => $request->gender,
            'short_bio' => $request->short_bio,
            'fees' => $request->fees,
        ];

        if ($request->password != null && trim($request->password) != '') {
            $requests += ['password' => Hash::make($request->password)];
        }

        User::whereId($id)->update($requests);


        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
