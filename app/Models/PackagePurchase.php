<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackagePurchase extends Model
{
    use HasFactory;

    protected $table = 'package_purchase';

    protected $fillable = [
        'user_id',
        'clinic_id',
        'price',
        'payment_method',
        'status',
        'expire_at',
    ];

}
