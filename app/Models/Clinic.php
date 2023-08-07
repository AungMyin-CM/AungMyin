<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Clinic extends Model
{
    use HasFactory;

    protected $table = 'clinic';

    protected $fillable = [
        'user_id', 'code', 'name', 'avatar', 'address', 'phoneNumber', 'package_id', 'package_purchased_date', 'package_purchased_times'
    ];

    public function expireDate()
    {
        return $this->hasOne(PackagePurchase::class, 'clinic_id', 'id');
    }

    public function package_purchase(): HasMany
    {
        return $this->hasMany(PackagePurchase::class, 'clinic_id');
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(Package::class);
    }

    public function patient(): HasMany
    {
        return $this->hasMany(Patient::class, 'clinic_code', 'id');
    }
}
