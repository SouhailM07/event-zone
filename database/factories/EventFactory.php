<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'thumbnail' => 'thumbnails/thumbnail.jpg',
            'location' => $this->faker->city(),
            'userId' => User::factory(),
            'coordination' => '34.0522,-118.2437',
            'whyRejected' => null,
            'price' => $this->faker->numberBetween(0, 100),
            'quantity' => $this->faker->numberBetween(0, 100),
            'validation' => 'approved',
            'started_at' => now()->addDays(1),
            'end_at' => now()->addDays(2),
        ];
    }

    /**
     * Indicate that the event validation is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'validation' => 'pending',
        ]);
    }

    /**
     * Indicate that the event validation is rejected.
     */
    public function rejected(?string $reason = 'Rejected by admin'): static
    {
        return $this->state(fn (array $attributes) => [
            'validation' => 'rejected',
            'whyRejected' => $reason,
        ]);
    }
}
