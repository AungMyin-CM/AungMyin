<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Support\Facades\Auth;

use App\Models\Role;

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

            $this->permissions = $permissions;
            $this->role_type = $role_type;

            view()->share(['permissions' => $permissions, 'role_type' => $role_type]);

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
}
