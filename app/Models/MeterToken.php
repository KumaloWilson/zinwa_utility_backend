<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeterToken extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'meter_id',
        'transaction_id',
        'token_number',
        'units',
        'amount',
        'status', // 'active', 'used', 'expired', 'cancelled'
        'generated_at',
        'used_at',
        'expires_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'generated_at' => 'datetime',
        'used_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    /**
     * Get the user that purchased the token.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the meter associated with the token.
     */
    public function meter()
    {
        return $this->belongsTo(Meter::class);
    }

    /**
     * Get the transaction associated with the token.
     */
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    /**
     * Check if token is active
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Check if token is used
     */
    public function isUsed()
    {
        return $this->status === 'used';
    }

    /**
     * Check if token is expired
     */
    public function isExpired()
    {
        return $this->status === 'expired' || ($this->expires_at && $this->expires_at->isPast());
    }
}

