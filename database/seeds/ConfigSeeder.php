<?php

use App\Config;
use Illuminate\Database\Seeder;

class ConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config = new Config();
        $config->name = 'WEBSOCKET_RECEIVER_URI';
        $config->value = 'battle.zone:8443';
        $config->save();

        $config = new Config();
        $config->name = 'WEBSOCKET_PLAYBACK_URI';
        $config->value = 'https://battle.zone:8448/dash/';
        $config->save();

    }
}
