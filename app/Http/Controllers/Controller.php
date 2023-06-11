<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Auth;

use App\Models\Role;
use App\Models\Notification;
use App\Models\UserClinic;
use App\Models\Clinic;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;



use App\Helpers\Helper;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $permissions;

    protected $role_type;

    public function __construct()
    {
        $permissions = '';

        $role_type = '';

        $this->middleware(function ($request, $next) {

            if(Auth::check())
            {

            $permissions = Role::where('id',Auth::guard('user')->user()['role_id'])->pluck('permissions')->first();

            $role_type = Role::where('id',Auth::guard('user')->user()['role_id'])->pluck('role_type')->first();

            $notifications = Notification::where(['receiver_id' => Auth::guard('user')->user()['id'], 'is_read' => 0])->get();

            $this->permissions = $permissions;
            $this->role_type = $role_type;

            $clinic_data = UserClinic::where('user_id', Auth::guard('user')->user()['id'])->get();

             if(count($clinic_data) >= 1)
            {
                    foreach($clinic_data as $clinic)
                    {
                        $user_clinic[] = Clinic::where('id',$clinic->clinic_id)->get();
                    }

                view()->share(['permissions' => $permissions, 'role_type' => $role_type, 'notis' => $notifications,'user_clinics' => $user_clinic]);


            }


        }

        return $next($request);

            
        });
    }

    public function checkPermission($string)
    {
        if (in_array($string,json_decode($this->permissions))){
            return true;
        }else{
            return false;
        }
        
    }

    public function isAdmin()
    {
        $role_type = Role::where('id',Auth::guard('user')->user()['role_id'])->pluck('role_type')->first();

        if($role_type == 5)
        {
            return true;

        }else{
            return false;
        }

    }
}
