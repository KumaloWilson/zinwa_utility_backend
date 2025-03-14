<?php

namespace Database\Factories;

use App\Models\Meter;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();
        $meter = Meter::factory()->create(['user_id' => $user->id]);
        $status = $this->faker->randomElement(['pending', 'completed', 'failed', 'refunded']);

        return [
            'user_id' => $user->id,
            'meter_id' => $meter->id,
            'reference' => 'TXN-' . Str::random(10),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'payment_method' => $this->faker->randomElement(['mobile_money', 'bank_transfer', 'card', 'cash']),
            'payment_provider' => $this->faker->company(),
            'status' => $status,
            'currency' => $this->faker->currencyCode(),
            'description' => $this->faker->sentence(),
            'metadata' => json_encode(['key' => 'value']),
            'completed_at' => $status === 'completed' ? $this->faker->dateTimeBetween('-1 year', 'now') : null,
            'refunded_at' => $status === 'refunded' ? $this->faker->dateTimeBetween('-1 year', 'now') : null,
        ];
    }

    /**
     * Indicate that the transaction is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'completed_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ]);
    }

    /**
     * Indicate that the transaction is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
            'completed_at' => null,
        ]);
    }

    /**
     * Indicate that the transaction failed.
     */
    public function failed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'failed',
            'completed_at' => null,
        ]);
    }

    /**
     * Indicate that the transaction was refunded.
     */
    public function refunded(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'refunded',
            'refunded_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ]);
    }
}
