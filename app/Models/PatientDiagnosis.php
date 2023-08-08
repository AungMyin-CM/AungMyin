<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDiagnosis extends Model
{
    use HasFactory;

    protected $table = 'patient_diagnosis';

    protected $fillable = [
        'uuid',
        'clinic',
        'user',
        'patient',
        'visit',
        'diagnosis',
        'created_at',
        'updated_at'
    ];
}
