<?php

use App\Battle;
use App\Request;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BattleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $verif = ['0','1'];
        $video_options = ['10','20','25'];
        for($i = 0;$i < 150; $i++){
            $id1 = rand(1,60);
            $id2 = null;
            while (!$id2){
                $id_rand = rand(1,60);
                if ($id_rand != $id1){
                    $id2 = $id_rand;
                }
            }
            $battle = new Battle();
            $battle->title = 'Our '.$i.'-nth battle';
            $battle->description = 'Lorem ipsum dolor ';
            $battle->gap = rand(0,4)*5;
            $battle->rounds = 3;
            $battle->start_date = rand(1,5) > 6 ?
                date("Y-m-d h:i:s",mktime(date('h') + rand(1,6), 0, 0, date('m'), date('d') + rand(1,5), date('Y'))) :
                date("Y-m-d h:i:s",mktime(date('h') - rand(1,6), date('i') - rand(1,6), 0, date('m'), date('d') - rand(1,5), date('Y')));
            $battle->time = \Carbon\Carbon::create();
            $battle->verified = $verif[rand(0,1)];
            $battle->end_date = date("Y-m-d", mt_rand(1,time()));
            $battle->video_options = ['mute' => rand(0,1)?'1':null, 'auto_change' => $video_options[rand(0,2)], 'screen_type' => 'auto'];
            $battle->category_id = rand(1,6);
            $battle->secret = 'bat_'.Str::random(10).time();
            $battle->current_status = 'ended';
            $battle->creator_id = $id1;
            $battle->assignee_id = $id2;
            $battle->save();

            $request = new Request();
            $request->answer = 'accepted';
            $request->battle_id = $battle->id;

            $request->creator_id = $id1;
            $request->assignee_id = $id2;

            $request->save();
            $ids = [$id1,$id2];
            for($j = 0; $j<15 ;$j++){
                DB::table('votes')->insert([
                    ['battle_id' => $battle->id, 'player_id' => $ids[rand(0,1)] , 'voter_id' => rand(1,10)]
                ]);
            }
        }

        //battles random players upcoming screen auto
        for($i = 0;$i < 200; $i++){
            $id1 = rand(1,60);
            $id2 = null;
            while (!$id2){
                $id_rand = rand(1,60);
                if ($id_rand != $id1){
                    $id2 = $id_rand;
                }
            }
            $battle = new Battle();
            $battle->title = 'Our '.$i.'-nth battle';
            $battle->description = 'Lorem ipsum dolor ';
            $battle->gap = rand(0,4)*5;
            $battle->rounds = 3;
            $battle->start_date = rand(1,5) > 0 ?
                date("Y-m-d h:i:s",mktime(date('h') + rand(1,6), 0, 0, date('m'), date('d') + rand(1,5), date('Y'))) :
                date("Y-m-d h:i:s",mktime(date('h') - rand(1,6), date('i') - rand(1,6), 0, date('m'), date('d') - rand(1,5), date('Y')));
            $battle->time = \Carbon\Carbon::create();
            $battle->verified = $verif[rand(0,1)];
            $battle->end_date = date("Y-m-d", mt_rand(1,time()));
            $battle->video_options = ['mute' => rand(0,1)?'1':null, 'auto_change' => $video_options[rand(0,2)], 'screen_type' => 'auto'];
            $battle->category_id = rand(1,5);
            $battle->secret = 'bat_'.Str::random(10).time();
            $battle->current_status = 'ended';
            $battle->creator_id = $id1;
            $battle->assignee_id = $id2;
            $battle->save();

            $request = new Request();
            $request->answer = 'accepted';
            $request->battle_id = $battle->id;

            $request->creator_id = $id1;
            $request->assignee_id = $id2;

            $request->save();
            $ids = [$id1,$id2];
            for($j = 0; $j<15 ;$j++){
                DB::table('votes')->insert([
                    ['battle_id' => $battle->id, 'player_id' => $ids[rand(0,1)] , 'voter_id' => rand(1,10)]
                ]);
            }
        }
        //battles random players upcoming screen manual
        for($i = 0;$i < 30; $i++){
            $id1 = rand(1,60);
            $id2 = null;
            while (!$id2){
                $id_rand = rand(1,60);
                if ($id_rand != $id1){
                    $id2 = $id_rand;
                }
            }
            $battle = new Battle();
            $battle->title = 'Our '.$i.'-nth battle';
            $battle->description = 'Lorem ipsum dolor ';
            $battle->gap = rand(0,4)*5;
            $battle->rounds = 3;
            $battle->start_date = rand(1,5) > 0 ?
                date("Y-m-d h:i:s",mktime(date('h') + rand(1,6), 0, 0, date('m'), date('d') + rand(1,5), date('Y'))) :
                date("Y-m-d h:i:s",mktime(date('h') - rand(1,6), date('i') - rand(1,6), 0, date('m'), date('d') - rand(1,5), date('Y')));
            $battle->time = \Carbon\Carbon::create();
            $battle->verified = $verif[rand(0,1)];
            $battle->end_date = date("Y-m-d", mt_rand(1,time()));
            $battle->video_options = ['mute' => rand(0,1)?'1':null, 'auto_change' => null, 'screen_type' => 'manual'];
            $battle->category_id = rand(1,5);
            $battle->secret = 'bat_'.Str::random(10).time();
            $battle->current_status = 'ended';
            $battle->creator_id = $id1;
            $battle->assignee_id = $id2;
            $battle->save();

            $request = new Request();
            $request->answer = 'accepted';
            $request->battle_id = $battle->id;

            $request->creator_id = $id1;
            $request->assignee_id = $id2;

            $request->save();
            $ids = [$id1,$id2];
            for($j = 0; $j<15 ;$j++){
                DB::table('votes')->insert([
                    ['battle_id' => $battle->id, 'player_id' => $ids[rand(0,1)] , 'voter_id' => rand(1,10)]
                ]);
            }
        }
        /*
        //battles random players upcoming screen in_sync
        for($i = 0;$i < 30; $i++){
            $id1 = rand(1,60);
            $id2 = null;
            while (!$id2){
                $id_rand = rand(1,60);
                if ($id_rand != $id1){
                    $id2 = $id_rand;
                }
            }
            $battle = new Battle();
            $battle->title = 'Our '.$i.'-nth battle';
            $battle->description = 'Lorem ipsum dolor ';
            $battle->gap = rand(0,4)*5;
            $battle->rounds = 3;
            $battle->start_date = rand(1,5) > 0 ?
                date("Y-m-d h:i:s",mktime(date('h') + rand(1,6), 0, 0, date('m'), date('d') + rand(1,5), date('Y'))) :
                date("Y-m-d h:i:s",mktime(date('h') - rand(1,6), date('i') - rand(1,6), 0, date('m'), date('d') - rand(1,5), date('Y')));
            $battle->time = \Carbon\Carbon::create();
            $battle->verified = $verif[rand(0,1)];
            $battle->end_date = date("Y-m-d", mt_rand(1,time()));
            $battle->video_options = ['mute' => rand(0,1)?'1':null, 'auto_change' => null, 'screen_type' => 'in_sync'];
            $battle->category_id = rand(1,5);
            $battle->secret = 'bat_'.Str::random(10).time();
            $battle->current_status = 'ended';
            $battle->creator_id = $id1;
            $battle->assignee_id = $id2;
            $battle->save();

            $request = new Request();
            $request->answer = 'accepted';
            $request->battle_id = $battle->id;

            $request->creator_id = $id1;
            $request->assignee_id = $id2;

            $request->save();
            $ids = [$id1,$id2];
            for($j = 0; $j<15 ;$j++){
                DB::table('votes')->insert([
                    ['battle_id' => $battle->id, 'player_id' => $ids[rand(0,1)] , 'voter_id' => rand(1,10)]
                ]);
            }
        }


        //battles random players random time  screen in_sync
        for($i = 0;$i < 400; $i++){
            $id1 = rand(1,60);
            $id2 = null;
            while (!$id2){
                $id_rand = rand(1,60);
                if ($id_rand != $id1){
                    $id2 = $id_rand;
                }
            }
            $battle = new Battle();
            $battle->title = 'Our '.$i.'-nth battle';
            $battle->description = 'Lorem ipsum dolor ';
            $battle->gap = rand(0,4)*5;
            $battle->rounds = 3;
            $battle->start_date = rand(1,5) > 3 ?
                date("Y-m-d h:i:s",mktime(date('h') + rand(1,6), 0, 0, date('m'), date('d') + rand(1,5), date('Y'))) :
                date("Y-m-d h:i:s",mktime(date('h') - rand(1,6), date('i') - rand(1,6), 0, date('m'), date('d') - rand(1,5), date('Y')));
            $battle->time = \Carbon\Carbon::create();
            $battle->verified = $verif[rand(0,1)];
            $battle->end_date = date("Y-m-d", mt_rand(1,time()));
            $battle->video_options = ['mute' => rand(0,1)?'1':null, 'auto_change' => null, 'screen_type' => 'in_sync'];
            $battle->category_id = rand(1,5);
            $battle->secret = 'bat_'.Str::random(10).time();
            $battle->current_status = 'ended';
            $battle->creator_id = $id1;
            $battle->assignee_id = $id2;
            $battle->save();

            $request = new Request();
            $request->answer = 'accepted';
            $request->battle_id = $battle->id;
            $request->creator_id =$id1;
            $request->assignee_id = $id2;

            $request->save();
            $ids = [$id1,$id2];
            for($j = 0; $j<15 ;$j++){
                DB::table('votes')->insert([
                    ['battle_id' => $battle->id, 'player_id' => $ids[rand(0,1)] , 'voter_id' => rand(1,10)]
                ]);
            }
        }*/

    }
}

