<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Authenticatable
{
    use HasFactory;

    protected $table = 'clinic';

    protected $guard = 'clinic';

    protected $fillable = [
        'name', 'email', 'phoneNumber',  'package_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}