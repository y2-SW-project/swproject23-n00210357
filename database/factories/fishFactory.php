<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\fish;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class fishFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    //allow user to flood database with fake info when run with seeder

    /*
    this is were seeder gets the random values when it fills the database with fake info
    uuid is filled with a random uuid
    user_id is hard coded to be user 1
    name uses faker name making it a random name
    description uses faker text giving it some random text
    image is hard coded with the image names and randomize between the three
    price uses faker random float 2 which is meant to fill it with a random float with up to point two digits but it usally comes up with an out of price bounds error that stops the seeding process but still fills in the prevously valid ones
    basket uses faker random digit not 2 which makes it a random single digit number (0, 1, 2, 3, 4, 5, 6, 7, 8, 9)
    */
    public function definition()
    {
            //sets what is to be filled with data when seeder is called
        return [
            'uuid' => Str::uuid(),
            'user_id' => $this->faker->randomElement([1, 1]),
            'fishType' => $this->faker->name(),
            'description' => $this->faker->text(),
            'image' => $this->faker->randomElement(['F1.jpg', 'F2.jpg', 'F3.jpg']),
            'price' => $this->faker->randomFloat(2, 0, 500),
            'fishery_id' => $this->faker->randomElement([1, 3]),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
