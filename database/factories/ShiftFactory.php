<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shift>
 */
class ShiftFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start = fake()->randomFloat(2, 0, 23);
        $end = fake()->randomFloat(2, $start, 24);
        return [
            'date' => fake()->dateTimeBetween(Carbon::now()->subMonths(1), Carbon::now()),
            'start' => $start,
            'end' => $end,
        ];
    }
}
