<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\fishery;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Fishery>
 */
class FisheryFactory extends Factory
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
            'location' => $this->faker->name(),
            'dock' => $this->faker->name(),
            'photo' => $this->faker->randomElement(['P1.jpg', 'P2.jpg', 'P3.jpg']),
        ];
    }
}
