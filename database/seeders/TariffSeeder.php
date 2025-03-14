<?php

namespace Database\Seeders;

use App\Models\Tariff;
use Illuminate\Database\Seeder;

class TariffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create basic tariff tiers
        Tariff::create([
            'name' => 'Residential Basic',
            'description' => 'Basic tariff for residential customers (0-50 units)',
            'rate_per_unit' => 0.50,
            'min_units' => 0,
            'max_units' => 50,
            'tax_percentage' => 5.0,
            'service_fee' => 2.00,
            'is_active' => true,
            'effective_from' => now(),
        ]);

        Tariff::create([
            'name' => 'Residential Standard',
            'description' => 'Standard tariff for residential customers (51-200 units)',
            'rate_per_unit' => 0.75,
            'min_units' => 51,
            'max_units' => 200,
            'tax_percentage' => 5.0,
            'service_fee' => 2.00,
            'is_active' => true,
            'effective_from' => now(),
        ]);

        Tariff::create([
            'name' => 'Residential Premium',
            'description' => 'Premium tariff for residential customers (201+ units)',
            'rate_per_unit' => 1.00,
            'min_units' => 201,
            'max_units' => null,
            'tax_percentage' => 5.0,
            'service_fee' => 2.00,
            'is_active' => true,
            'effective_from' => now(),
        ]);

        Tariff::create([
            'name' => 'Commercial Basic',
            'description' => 'Basic tariff for commercial customers',
            'rate_per_unit' => 1.25,
            'min_units' => 0,
            'max_units' => null,
            'tax_percentage' => 7.5,
            'service_fee' => 5.00,
            'is_active' => true,
            'effective_from' => now(),
        ]);

        Tariff::create([
            'name' => 'Industrial',
            'description' => 'Tariff for industrial customers',
            'rate_per_unit' => 1.50,
            'min_units' => 0,
            'max_units' => null,
            'tax_percentage' => 10.0,
            'service_fee' => 10.00,
            'is_active' => true,
            'effective_from' => now(),
        ]);
    }
}

