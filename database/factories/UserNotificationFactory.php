<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserNotification;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserNotificationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserNotification::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = $this->faker->randomElement(['payment', 'token', 'meter', 'system']);
        $isRead = $this->faker->boolean(30);

        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(3),
            'message' => $this->faker->paragraph(),
            'type' => $type,
            'read_at' => $isRead ? $this->faker->dateTimeBetween('-30 days', 'now') : null,
            'data' => json_encode(['key' => 'value']),
        ];
    }

    /**
     * Indicate that the notification is read.
     */
    public function read(): static
    {
        return $this->state(fn (array $attributes) => [
            'read_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ]);
    }

    /**
     * Indicate that the notification is unread.
     */
    public function unread(): static
    {
        return $this->state(fn (array $attributes) => [
            'read_at' => null,
        ]);
    }

    /**
     * Indicate that the notification is for a payment.
     */
    public function payment(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'payment',
            'title' => 'Payment Notification',
            'data' => json_encode([
                'transaction_id' => $this->faker->randomNumber(5),
                'amount' => $this->faker->randomFloat(2, 10, 1000),
                'status' => $this->faker->randomElement(['completed', 'failed']),
            ]),
        ]);
    }

    /**
     * Indicate that the notification is for a token.
     */
    public function token(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'token',
            'title' => 'Token Generated',
            'data' => json_encode([
                'token_number' => $this->faker->numerify('####################'),
                'units' => $this->faker->randomFloat(2, 10, 500),
            ]),
        ]);
    }
}
