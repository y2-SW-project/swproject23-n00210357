<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\basket>
 */
class BasketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
            //sets what is to be filled with data when seeder is called
        return [
            'uuid' => Str::uuid(),
            'user_id' => $this->faker->randomElement([1, 2]),
            'location' => $this->faker->text,
            'station_master' => $this->faker->name,
            'picture' => $this->faker->randomElement(['B1.jpg', 'B2.jpg', 'B3.jpg']),
            'has_dock' => $this->faker->randomElement([0, 1]),
            'has_airport' => $this->faker->randomElement([0, 1]),
        ];
    }
}