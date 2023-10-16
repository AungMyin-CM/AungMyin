<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientProcedure extends Model
{
    use HasFactory;

    protected $table = 'patient_procedure';

    protected $fillable = [
        'uuid',
        'visit_id',
        'patient_id',
        'assigned_tasks',
        'price',
        'is_pos',
        'created_at'
    ];
}
