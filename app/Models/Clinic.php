<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    protected $table = 'clinic';

    protected $fillable = [
        'user_id','code','name', 'address', 'phoneNumber','package_id','package_purchased_date','package_purchased_times'
    ];
}