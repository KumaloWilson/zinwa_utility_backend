<?php

namespace App\Services;

use App\Models\ConsumptionRecord;
use App\Models\Meter;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MeterService
{
    /**
     * Get meters for a user
     */
    public function getUserMeters(User $user)
    {
        if ($user->isAdmin()) {
            return Meter::paginate(15);
        }

        return $user->meters()->paginate(15);
    }

    /**
     * Register a new meter
     */
    public function registerMeter(User $user, array $data): Meter
    {
        $meter = new Meter([
            'meter_number' => $data['meter_number'],
            'meter_type' => $data['meter_type'] ?? 'prepaid',
            'location' => $data['location'] ?? null,
            'installation_date' => $data['installation_date'] ?? now(),
            'notes' => $data['notes'] ?? null,
        ]);

        $user->meters()->save($meter);

        // Attempt to validate the meter with the utility provider
        if (isset($data['validate']) && $data['validate']) {
            $this->validateMeter($meter);
        }

        return $meter;
    }

    /**
     * Update meter details
     */
    public function updateMeter(Meter $meter, array $data): Meter
    {
        $meter->fill($data);
        $meter->save();

        return $meter;
    }

    /**
     * Validate meter with utility provider
     */
    public function validateMeter(Meter $meter): bool
    {
        try {
            // In a real app, you would make an API call to the utility provider
            // For now, we'll simulate a successful validation

            // Simulate API call
            // $response = Http::post('https://api.utility-provider.com/validate-meter', [
            //     'meter_number' => $meter->meter_number,
            // ]);

            // if ($response->successful()) {
            //     $data = $response->json();
            //     // Update meter with data from provider if needed
            // }

            // For demo, always mark as validated
            $meter->is_validated = true;
            $meter->validation_date = now();
            $meter->save();

            return true;
        } catch (\Exception $e) {
            Log::error('Meter validation failed: ' . $e->getMessage(), [
                'meter_id' => $meter->id,
                'meter_number' => $meter->meter_number,
            ]);

            return false;
        }
    }

    /**
     * Get consumption history for a meter
     */
    public function getConsumptionHistory(Meter $meter): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $meter->consumptionRecords()
            ->orderBy('reading_date', 'desc')
            ->paginate(15);
    }

    /**
     * Record consumption for a meter
     */
    public function recordConsumption(Meter $meter, $reading, $units, $readingType = 'automatic'): ConsumptionRecord
    {
        $record = new ConsumptionRecord([
            'reading' => $reading,
            'units_consumed' => $units,
            'reading_date' => now(),
            'reading_type' => $readingType,
        ]);

        $meter->consumptionRecords()->save($record);

        // Update meter's last reading
        $meter->last_reading = $reading;
        $meter->last_reading_date = now();
        $meter->save();

        return $record;
    }
}

