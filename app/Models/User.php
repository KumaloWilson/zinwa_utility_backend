<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role', // 'admin', 'vendor', 'consumer'
        'email_verified_at',
        'phone_verified_at',
        'status', // 'active', 'inactive', 'suspended'
        'last_login_at',
        'last_login_ip',
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

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'phone_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_login_at' => 'datetime',
    ];

    /**
     * Get the meters associated with the user.
     */
    public function meters()
    {
        return $this->hasMany(Meter::class);
    }

    /**
     * Get the tokens purchased by the user.
     */
//    public function tokens()
//    {
//        return $this->hasMany(MeterToken::class);
//    }

    /**
     * Get the transactions made by the user.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Get the notifications for the user.
     */
    public function userNotifications()
    {
        return $this->hasMany(UserNotification::class);
    }

    /**
     * Check if user has a specific role
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    /**
     * Check if user is an admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is a vendor
     */
    public function isVendor()
    {
        return $this->role === 'vendor';
    }

    /**
     * Check if user is a consumer
     */
    public function isConsumer()
    {
        return $this->role === 'consumer';
    }
}

