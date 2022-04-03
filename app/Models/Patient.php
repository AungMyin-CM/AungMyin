<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
