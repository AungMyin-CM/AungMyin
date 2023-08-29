<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $table = 'user';

    protected $guard = 'user';

    protected $fillable = [
        'code',
        'name',
        'avatar',
        'role_id',
        'clinic_id',
        'speciality',
        'credentials',
        'email',
        'password',
        'phoneNumber',
        'city',
        'country',
        'address',
        'email_verified',
        'short_bio',
        'fees',
        'status',
        'gender',
        'otp',
        'is_superadmin',
        'first_name',
        'last_name',
        'lastest_ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function roleType()
    {
        return $this->hasOne(Role::class, 'id', 'role_id');
    }

    public function roles()
    {
        return $this->HasMany(Role::class, 'id', 'role_id');
    }

    function isAdmin()
    {
        return $this->roles()->where('role_type', '5')->exists();
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function package_purchase(): HasOne
    {
        return $this->hasOne(PackagePurchase::class);
    }

    public function user_clinic(): HasOne
    {
        return $this->hasOne(UserClinic::class);
    }

    public function clinic(): BelongsTo
    {
        return $this->belongsTo(Clinic:: class);
    }
}
