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

    public function __construct()
    {
        $permissions = '';

        $this->middleware(function ($request, $next) {

            if (Auth::guard('user')->user()){

                $permissions = Role::where('id',Auth::guard('user')->user()['id'])->pluck('permissions')->first();
                $this->permissions = $permissions;
                view()->share('permissions',$permissions);   
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
