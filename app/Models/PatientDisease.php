<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;



class PatientDisease extends Model
{
    use HasFactory;

    protected $table = 'patient_disease';

    protected $fillable = [
        'uuid',
        'clinic',
        'user',
        'patient',
        'visit_id',
        'disease',
        'created_at',
        'updated_at'
    ];

    public function visit(): BelongsTo
    {
        return $this->belongsTo(Patient::class,'patient','id');
    }
}
