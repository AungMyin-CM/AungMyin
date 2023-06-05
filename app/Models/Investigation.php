<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investigation extends Model
{
    use HasFactory;

    protected $table = 'investigation';

    protected $fillable = [ 
        'code','name','clinic_id','price'
    ];

}
