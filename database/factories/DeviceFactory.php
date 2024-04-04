<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => "BSAT" . fake()->randomNumber(4),
            'type' => fake()->randomElement(\App\Models\Device::TYPES),
            'description' => fake()->sentence(),
            'status' => "online",
            'proximity' => fake()->randomFloat(2, 0, 100),
            'imageUrl' => fake()->imageUrl(),
            'connection' => fake()->randomElement(\App\Models\Device::CONNECTION_TYPES),
            'connection_strength' => fake()->numberBetween(1, 5),
            'battery' => fake()->randomFloat(2, 0, 100),
        ];
    }
}
