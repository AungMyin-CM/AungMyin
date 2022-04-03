<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

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
}