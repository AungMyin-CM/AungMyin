<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClinic extends Model
{
    use HasFactory;

    protected $table = 'user_clinic';

    protected $fillable = [
        'user_id',
        'clinic_id',
        'status',    
        'deleted_date'    
    ];

    public function clinic()
    {
        return $this->hasMany(Clinic::class,'id','clinic_id');

    }

    public function expire()
    {
        return $this->hasMany(PackagePurchase::class,'clinic_id','clinic_id');
    }

    protected $dateFormat = 'Y-m-d H:i:s';

}
