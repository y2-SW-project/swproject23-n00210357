<?php

namespace Database\Seeders;

use App\Models\fishery;
use App\Models\fish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FisherySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //runs fisheryFactory.php when called in terminal

    //when this is run it attempts to use factory to input 10 filler fisheries into the fishery table of the database
    public function run()
    {
        fishery::factory()->times(3)->create();

        foreach(fish::all() as $fish)
        {
            $fisheries = fishery::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $fish->fishery()->attach($fisheries);
        }
    }
}
