<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transaction';

    protected $fillable = [
        'guid',
        'user_id',
        'package_id',
        'cost_amount',
        'paid_amount',
        'agent',
        'discount',
        'on_trial',
        'created_at'
    ];

}
