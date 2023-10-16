<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDoctor extends Model
{
    use HasFactory;

    protected $table = 'patient_doctor';

    protected $fillable = [
        'patient_id',
        'user_id',
        'status',
        'end_time'
    ];
}
