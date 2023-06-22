<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
