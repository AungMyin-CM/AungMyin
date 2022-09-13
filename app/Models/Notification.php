<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $table = 'notification';

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'clinic_id',
        'patient_id',
        'is_sent',
        'is_read',
        'action_on_sent',
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'receiver_id');
    }

    public function clinic(){
        return $this->hasOne(Clinic::class, 'id', 'clinic_id');
    }

    public function patient(){
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }
}
