<?php

use App\Player;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 60; $i++){
            $user = new User();
            $user->full_name = [
                'first_name' => 'John',
                'last_name'  =>  'Doe',
                'middle_name' => 'Adam',
                'username'=>'mukik'
            ];
            $user->country_id = 11;
            $user->dob = now();
            $user->nickname = 'User'.$i;
            $user->state_id = 232;
            $user->city_id = 6532;
            $user->email = 'user'.$i.'@gmail.com';
            $user->password = bcrypt('user123456');
            $user->avatar = 'default_avatar_'.rand(1,36).'.png';
            $user->save();

            $player = new Player();
            $player->user_id = $user->id;
            $player->rating_id = 2;
            $player->save();
        }



    }
}
