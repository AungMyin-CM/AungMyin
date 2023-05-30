<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic::class);
    }
}
