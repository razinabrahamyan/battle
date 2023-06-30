<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(WorldSeeder::class);
        //$this->call(VoteSeeder::class);
        //$this->call(PlayerSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BattleSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(LocalesSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(ConfigSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(ReasonSeeder::class);
        $this->call(EmojiSeeder::class);

    }
}
