<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
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
        'reference',
        'amount',
        'payment_method', // 'mobile_money', 'bank_transfer', 'card', etc.
        'payment_provider',
        'status', // 'pending', 'completed', 'failed', 'refunded'
        'currency',
        'description',
        'metadata',
        'completed_at',
        'refunded_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount' => 'decimal:2',
        'metadata' => 'array',
        'completed_at' => 'datetime',
        'refunded_at' => 'datetime',
    ];

    /**
     * Get the user that made the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the meter associated with the transaction.
     */
    public function meter()
    {
        return $this->belongsTo(Meter::class);
    }

    /**
     * Get the token generated from this transaction.
     */
    public function token()
    {
        return $this->hasOne(Token::class);
    }

    /**
     * Check if transaction is completed
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    /**
     * Check if transaction is pending
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if transaction is failed
     */
    public function isFailed()
    {
        return $this->status === 'failed';
    }

    /**
     * Check if transaction is refunded
     */
    public function isRefunded()
    {
        return $this->status === 'refunded';
    }
}

