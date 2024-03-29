<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Package extends Model
{
    use HasFactory;

    protected $table = 'package';

    protected $fillable = ['name', 'type', 'price', 'trialPeriod', 'isDiscount', 'discountPercentage', 'discountStartDate', 'discountEndDate'];

    public function clinic(): HasMany
    {
        return $this->hasMany(Clinic::class, 'package_id');
    }
}
