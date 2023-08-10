<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDisease extends Model
{
    use HasFactory;

    protected $table = 'patient_disease';

    protected $fillable = [
        'uuid',
        'clinic',
        'user',
        'patient',
        'visit',
        'disease',
        'created_at',
        'updated_at'
    ];
}
