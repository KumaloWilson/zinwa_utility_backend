<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meter extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'meter_number',
        'meter_type', // 'prepaid', 'postpaid'
        'location',
        'status', // 'active', 'inactive', 'blocked'
        'last_reading',
        'last_reading_date',
        'installation_date',
        'is_validated',
        'validation_date',
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'last_reading_date' => 'datetime',
        'installation_date' => 'datetime',
        'validation_date' => 'datetime',
        'is_validated' => 'boolean',
    ];

    /**
     * Get the user that owns the meter.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the consumption records for the meter.
     */
    public function consumptionRecords()
    {
        return $this->hasMany(ConsumptionRecord::class);
    }

    /**
     * Get the tokens used for this meter.
     */
    public function tokens()
    {
        return $this->hasMany(MeterToken::class);
    }


    /**
     * Check if meter is active
     */
    public function isActive()
    {
        return $this->status === 'active';
    }

    /**
     * Check if meter is blocked
     */
    public function isBlocked()
    {
        return $this->status === 'blocked';
    }
}

