<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UserClinic;


use Auth;

class UserController extends Controller
{
    public function index()
    {
        return view('registration/user');
    }

    public function userList()
    {

        if(!$this->checkPermission("user_view")){
            abort(404);
        }

        $clinic_id = session()->get('cc_id');

        $user_id = UserClinic::where('clinic_id', $clinic_id)->pluck('user_id');

        $userData = User::whereIn('id',$user_id)->where('status','1')->get();

        return view('user/index')->with('data',$userData);
    }

    public function register(UserRegisterRequest $request)
    {        
        $user = new User();

            if($request->file('avatar') != '')
            {
                $file= $request->file('avatar');
                $filename= date('YmdHi').'-'.$file->getClientOriginalName();    
                $file->move(public_path('images/avatars'), $filename);
            }

            $user_id = $user->create([
                'code' => $request->code,
                'name' => $request->name,
                'avatar' => $filename,
                'email' => $request->email,
                'password' => $request->password,
                'phoneNumber' => $request->phoneNumber,
                'city' => $request->city,
                'country' => $request->country,
                'address' => $request->address,
                'gender' => $request->gender
            ])->id;

            $hash = $this->generateTokenVerify();
            $token = $user_id.$hash;
            $verifyURL = route('verify',['token'=>$hash,'value'=>$user_id,'service'=>'Email_verification']);
           
            $message = 'Dear <b>'.$request->name.'</b>';
            $message = 'Thanks for singing up, we just need to verify your email address';
            $mail_data=[
                'recipient' =>$request->email,
                'fromEmail' =>'aungmyin.cm@gmail.com',
                'fromName' =>'Aung Myin Authentication',
                'subject' =>'Email Verification',
                'body'=>$message,
                'actionLink' =>$verifyURL,
            ];
            \Mail::send('email-template',$mail_data,function($message) use ($mail_data){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'], $mail_data['fromName'])
                        ->subject($mail_data['subject']);
            });
            
            return redirect('/')->with('success','You need to verify your account. We have sent you an activation link, please check your mail');
    } 
    
        public function generateTokenVerify()
        {
            $characters = 'MV4560GM678ZA0B0E1DABCDEFGHIJKLM';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < 6; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
                $finalVerifynumber = 'GH' . $randomString;
            }
            return $finalVerifynumber;
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
                    return redirect('/')->with('success', 'Your email is verified successfully. You can now login')->with('verifiedEmail', $verifyUser->email);
                    // return view('login')->with('verifiedEmail',$user->email);
                } else {
                    return redirect('/')->with('success', 'Your email already verified successfully. You can now login')->with('verifiedEmail', $verifyUser->email);
                    // return 'Already Verified';
                }
            }
        }

        public function checkUsername(Request $request)
        {
            if($request->get('username'))
            {
                $username = $request->get('username');
                $data = User::where('code', $username)
                ->count();
                if($data > 0)
                {
                    echo 'not_unique';
                }
                else
                {
                    echo 'unique';
                }
            }
        }


        public function checkEmail(Request $request)
        {
            if($request->get('email'))
            {
                $email = $request->get('email');
                $data = User::where('email', $email)
                ->count();
                if($data > 0)
                {
                    echo 'not_unique';
                }
                else
                {
                    echo 'unique';
                }
            }
        }
}
