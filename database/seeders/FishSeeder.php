<?php

namespace Database\Seeders;

use App\Models\fish;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FishSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //runs trainFactory.php when called in terminal

    //when this is run it attempts to use factory to input 10 filler fishs into the fish table of the database
    public function run()
    {
        fish::factory()->times(10)->create();
    }
}
