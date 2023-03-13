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
            'cost' => $this->faker->randomFloat(2, 0, 500),
        ];
    }
}
