<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use App\Models\Role;
use Auth;


class Helper
{
    public static function checkPermission($string,$permissions)
    {
        if (in_array($string,json_decode($permissions))){
            return true;
        }else{
            return false;
        }
        
    }

    public static function isAdmin()
    {
        $role_type = Role::where('id',Auth::guard('user')->user()['role_id'])->pluck('role_type')->first();

        if($role_type == 5)
        {
            return true;

        }else{
            return false;
        }

    }

    public static function isMobile()
    {
        return (bool) preg_match('/(android|webos|iphone|ipod|blackberry|iemobile|opera mini)/i', request()->server('HTTP_USER_AGENT'));
    }
}