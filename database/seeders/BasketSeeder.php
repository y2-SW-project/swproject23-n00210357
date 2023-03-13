<?php

namespace Database\Seeders;

use App\Models\basket;
use App\Models\fish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BasketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

     //when this is run it attempts to use factory to input 10 filler baskets into the basket table of the database
    public function run()
    {
        Basket::factory()->times(3)->create();

        foreach(fish::all() as $fish)
        {
            $baskets = basket::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $fish->basket()->attach($baskets);
        }
    }
}
