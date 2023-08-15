<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patient';

    protected $fillable = [
        'user_id',
        'code',
        'name',
        'father_name',
        'clinic_code',
        'age',
        'phoneNumber',
        'address',
        'gender',
        'summary',
        'drug_allergy',
        'status',
        'Ref',
        'p_status',
        'delete_at'
    ];

    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class, 'clinic_code', 'id');
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class, 'patient_id')->where('deleted_at',null);
    }

    
    public function disease(): HasMany
    {
        return $this->hasMany(PatientDisease::class, 'patient')->orderBy('updated_at','desc')->take(1);
    }

    // public function doctors(): BelongsToMany
    // {
    //     return $this->belongsToMany(User::class, 'patient_doctor', 'patient_id', 'user_id');
    // }
}
