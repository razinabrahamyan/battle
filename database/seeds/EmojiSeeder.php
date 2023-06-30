<?php

use App\Emoji;
use Illuminate\Database\Seeder;

class EmojiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name' => 'heart',	      'code' =>'128151' ],
            ['name' => 'smile',	      'code' =>'128512' ],
            ['name' => 'laugh',	      'code' =>'128514' ],
            ['name' => 'like',	      'code' =>'128077' ],
            ['name' => 'clap',	      'code' =>'128079' ],
            ['name' => 'dislike',	  'code' =>'128078' ],
            ['name' => 'angry',	      'code' =>'128520' ],

        ];

        Emoji::insert($data);
    }
}
