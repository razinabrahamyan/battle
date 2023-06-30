<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0;$i < 810; $i++){
            for($j = 0; $j<65 ;$j++){
                DB::table('votes')->insert([
                    ['battle_id' => $i+1, 'player_id' => rand(1,2) + 1, 'voter_id' => rand(1,10)]
                ]);
            }

        }

    }
}
