<?php

namespace Database\Seeders;

use App\Models\catcher;
use App\Models\fish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatcherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //runs driverFactory.php when called in terminal

    //when this is run it attempts to use factory to input 10 filler catchers into the catcher table of the database
    public function run()
    {
        catcher::factory()->times(3)->create();

        foreach(fish::all() as $fish)
        {
            $catchers = catcher::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $fish->catcher()->attach($catchers);
        }
    }
}
