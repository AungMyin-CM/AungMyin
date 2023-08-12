<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


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
    
    public function visit(): BelongsTo
    {
        return $this->belongsTo(Visit::class,'visit','id');
    }
}
