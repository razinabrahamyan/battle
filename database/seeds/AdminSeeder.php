<?php

use App\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->role_id = 1;
        $admin->email = 'admin@gmail.com';
        $admin->password = bcrypt('123456');
        $admin->country_id = 11;
        $admin->state_id = 232;
        $admin->city_id = 6532;
        $admin->full_name = [
            'first_name'  => 'Super',
            'last_name'   => 'Admin',
            'middle_name' =>  null
        ];
        $admin->save();

        $admin = new Admin();
        $admin->role_id = 3;
        $admin->email = 'moderator@gmail.com';
        $admin->password = bcrypt('123456');
        $admin->country_id = 11;
        $admin->state_id = 232;
        $admin->city_id = 6532;
        $admin->full_name = [
            'first_name'  => 'Moderator',
            'last_name'   => 'Admin',
            'middle_name' =>  null
        ];
        $admin->save();
    }
}
