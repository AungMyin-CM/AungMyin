<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Pharmacy;

class PosItem extends Model
{
    use HasFactory;

    protected $table = 'pos_item';

    protected $fillable = [
        'pos_id',
        'med_id',
        'med_name',
        'quantity',
        'expire_date',
        'act_price',
        'unit',
        'margin',
        'sell_price',
        'total_price',
        'discount',
    ];

    public function pharmacy()
    {
        return $this->hasOne(Pharmacy::class, 'id', 'med_id');
        
    }
    
}
