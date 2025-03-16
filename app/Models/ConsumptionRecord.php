<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsumptionRecord extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'meter_id',
        'token_id',
        'reading',
        'units_consumed',
        'reading_date',
        'reading_type', // 'manual', 'automatic', 'estimated'
        'notes',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'reading' => 'decimal:2',
        'units_consumed' => 'decimal:2',
        'reading_date' => 'datetime',
    ];

    /**
     * Get the meter associated with the consumption record.
     */
    public function meter()
    {
        return $this->belongsTo(Meter::class);
    }

    /**
     * Get the token associated with the consumption record.
     */
    public function token()
    {
        return $this->belongsTo(Meter::class);
    }
}

