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
        'fees',
        'user_id',
        'investigation',
        'procedure',
        'is_folloup',
        'followup_date',
        'status'
    ];

}
