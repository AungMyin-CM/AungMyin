<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    use HasFactory;

    protected $table = 'pharmacy';

    protected $fillable = [
        'user_id',
        'clinic_id',
        'code',
        'name',
        'expire_date',
        'quantity',
        'act_price',
        'margin',
        'sell_price',
        'unit',
        'description',
        'vendor',
        'vendor_phoneNumber',
        'status',
        'storage_place',
        'delete_at'
    ];
    
}
