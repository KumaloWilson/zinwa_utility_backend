<?php

namespace Database\Factories;

use App\Models\Meter;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeterFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Meter::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'meter_number' => 'M' . $this->faker->unique()->numerify('######'),
            'meter_type' => $this->faker->randomElement(['prepaid', 'postpaid']),
            'location' => $this->faker->address(),
            'status' => $this->faker->randomElement(['active', 'inactive', 'blocked']),
            'last_reading' => $this->faker->randomFloat(2, 0, 1000),
            'last_reading_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'installation_date' => $this->faker->dateTimeBetween('-5 years', '-1 year'),
            'is_validated' => $this->faker->boolean(70),
            'validation_date' => function (array $attributes) {
                return $attributes['is_validated'] ? $this->faker->dateTimeBetween('-1 year', 'now') : null;
            },
            'notes' => $this->faker->optional(0.7)->sentence(),
        ];
    }

    /**
     * Indicate that the meter is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
        ]);
    }

    /**
     * Indicate that the meter is inactive.
     */
    public function inactive(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'inactive',
        ]);
    }

    /**
     * Indicate that the meter is blocked.
     */
    public function blocked(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'blocked',
        ]);
    }
}
