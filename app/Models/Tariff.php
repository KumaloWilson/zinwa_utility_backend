<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Tariff extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'rate_per_unit',
        'min_units',
        'max_units',
        'tax_percentage',
        'service_fee',
        'is_active',
        'effective_from',
        'effective_to',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'rate_per_unit' => 'decimal:2',
        'tax_percentage' => 'decimal:2',
        'service_fee' => 'decimal:2',
        'is_active' => 'boolean',
        'effective_from' => 'datetime',
        'effective_to' => 'datetime',
    ];

    /**
     * Check if tariff is currently active
     */
    public function isCurrentlyActive()
    {
        $now = now();
        return $this->is_active &&
               ($this->effective_from === null || $this->effective_from <= $now) &&
               ($this->effective_to === null || $this->effective_to >= $now);
    }

    /**
     * Calculate the total cost for a given number of units
     */
    public function calculateCost($units)
    {
        if ($units < $this->min_units || ($this->max_units !== null && $units > $this->max_units)) {
            return null;
        }

        $baseAmount = $units * $this->rate_per_unit;
        $taxAmount = $baseAmount * ($this->tax_percentage / 100);

        return $baseAmount + $taxAmount + $this->service_fee;
    }
}

