<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    use HasFactory;

    protected $table = 'pos';

    protected $fillable = [
        'invoice_code',
        'user_id',
        'patient_id',
        'customer_name',
        'total_price',
        'total_discount',
        'description',
        'status',
        'payment_status',
        'deleted_at',
    ];
}
