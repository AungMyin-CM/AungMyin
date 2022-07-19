<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClinic extends Model
{
    use HasFactory;

    protected $table = 'user_clinic';

    protected $fillable = [
        'user_id',
        'clinic_id',
        'status',    
        'deleted_date'    
    ];
}
