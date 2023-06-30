<?php

use App\ExtraModels\Settings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'title' => 'battle',
            'attributes' => ['rounds_min' => 1, 'rounds_max' => 10]
        ]);

    }
}
