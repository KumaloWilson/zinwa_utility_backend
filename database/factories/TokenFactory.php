<?php

namespace Database\Factories;

use App\Models\Meter;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TokenFactory extends Factory
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
        $user = User::factory()->create();
        $meter = Meter::factory()->create(['user_id' => $user->id]);
        $transaction = Transaction::factory()->create([
            'user_id' => $user->id,
            'meter_id' => $meter->id
        ]);

        $units = $this->faker->randomFloat(2, 10, 500);
        $amount = $units * $this->faker->randomFloat(2, 0.5, 2.0);

        return [
            'user_id' => $user->id,
            'meter_id' => $meter->id,
            'transaction_id' => $transaction->id,
            'token_number' => $this->faker->unique()->numerify('####################'),
            'units' => $units,
            'amount' => $amount,
            'status' => $this->faker->randomElement(['active', 'used', 'expired', 'cancelled']),
            'generated_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'used_at' => function (array $attributes) {
                return $attributes['status'] === 'used' ? $this->faker->dateTimeBetween('-1 year', 'now') : null;
            },
            'expires_at' => $this->faker->dateTimeBetween('now', '+30 days'),
        ];
    }

    /**
     * Indicate that the token is active.
     */
    public function active(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'active',
            'used_at' => null,
        ]);
    }

    /**
     * Indicate that the token is used.
     */
    public function used(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'used',
            'used_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ]);
    }

    /**
     * Indicate that the token is expired.
     */
    public function expired(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'expired',
            'expires_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ]);
    }
}
