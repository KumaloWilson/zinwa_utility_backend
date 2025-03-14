<?php

namespace App\Services;

use App\Models\Tariff;

class TariffService
{
    /**
     * Get all active tariffs
     */
    public function getActiveTariffs()
    {
        return Tariff::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('effective_from')
                    ->orWhere('effective_from', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('effective_to')
                    ->orWhere('effective_to', '>=', now());
            })
            ->get();
    }

    /**
     * Calculate price for units
     */
    public function calculatePrice($units): array
    {
        // Find applicable tariff
        $tariff = $this->findApplicableTariff($units);

        if (!$tariff) {
            throw new \Exception('No applicable tariff found for ' . $units . ' units');
        }

        // Calculate base amount
        $baseAmount = $units * $tariff->rate_per_unit;

        // Calculate tax
        $taxAmount = $baseAmount * ($tariff->tax_percentage / 100);

        // Add service fee
        $totalAmount = $baseAmount + $taxAmount + $tariff->service_fee;

        return [
            'base_amount' => round($baseAmount, 2),
            'tax_amount' => round($taxAmount, 2),
            'service_fee' => round($tariff->service_fee, 2),
            'total_amount' => round($totalAmount, 2),
            'tariff' => $tariff,
        ];
    }

    /**
     * Find applicable tariff for units
     */
    private function findApplicableTariff($units)
    {
        return Tariff::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('effective_from')
                    ->orWhere('effective_from', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('effective_to')
                    ->orWhere('effective_to', '>=', now());
            })
            ->where(function ($query) use ($units) {
                $query->where('min_units', '<=', $units)
                    ->where(function ($q) use ($units) {
                        $q->whereNull('max_units')
                            ->orWhere('max_units', '>=', $units);
                    });
            })
            ->orderBy('rate_per_unit', 'desc')
            ->first();
    }

    /**
     * Get unit price (for simple calculations)
     */
    public function getUnitPrice()
    {
        // Get the basic tariff
        $tariff = Tariff::where('is_active', true)
            ->where('min_units', 0)
            ->orderBy('rate_per_unit', 'asc')
            ->first();

        return $tariff ? $tariff->rate_per_unit : 1.0;
    }
}

