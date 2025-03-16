<?php

namespace Database\Factories;

use App\Models\ConsumptionRecord;
use App\Models\Meter;
use App\Models\Meter;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConsumptionRecordFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ConsumptionRecord::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $meter = Meter::factory()->create();
        $reading = $this->faker->randomFloat(2, 100, 10000);
        $previousReading = $this->faker->randomFloat(2, 0, $reading - 10);
        $unitsConsumed = $reading - $previousReading;

        return [
            'meter_id' => $meter->id,
            'token_id' => null, // Optional relation
            'reading' => $reading,
            'units_consumed' => $unitsConsumed,
            'reading_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'reading_type' => $this->faker->randomElement(['manual', 'automatic', 'estimated']),
            'notes' => $this->faker->optional(0.3)->sentence(),
        ];
    }

    /**
     * Indicate that the reading is manual.
     */
    public function manual(): static
    {
        return $this->state(fn (array $attributes) => [
            'reading_type' => 'manual',
        ]);
    }

    /**
     * Indicate that the reading is automatic.
     */
    public function automatic(): static
    {
        return $this->state(fn (array $attributes) => [
            'reading_type' => 'automatic',
        ]);
    }

    /**
     * Indicate that the reading is estimated.
     */
    public function estimated(): static
    {
        return $this->state(fn (array $attributes) => [
            'reading_type' => 'estimated',
        ]);
    }
}
