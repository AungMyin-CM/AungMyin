<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class,'package_id','id');
    }

}
