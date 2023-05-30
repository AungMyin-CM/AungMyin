<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'pos_id',
        'prescription',
        'diag',
        'assigned_medicines',
        'images',
        'is_foc',
        'fees',
        'user_id',
        'investigation',
        'procedure',
        'is_followup',
        'followup_date',
        'sys_bp',
        'dia_bp',
        'pr',
        'temp',
        'spo2',
        'rbs',
        'status'
    ];

}
