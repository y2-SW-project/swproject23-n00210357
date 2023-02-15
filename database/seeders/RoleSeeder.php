<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    //runs trainFactory.php when called in terminal

    //when this is run it attempts to use factory to input 10 filler roles into the role table of the database
    public function run()
    {
        $role_admin = new Role();
        $role_admin->name = 'angler';
        $role_admin->description = 'A seller';
        $role_admin->save();

        $role_user = new Role();
        $role_user->name = 'customer';
        $role_user->description = 'A customer';
        $role_user->save();
    }
}
