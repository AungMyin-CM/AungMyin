<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'pos_id',
        'prescription',
        'diag',
        'disease',
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

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    public function diagnosis()
    {
        return $this->hasMany(PatientDiagnosis::class, 'visit' ,'id');
    }

    public function disease()
    {
        return $this->hasMany(PatientDisease::class, 'visit_id' ,'id');
    }
}
