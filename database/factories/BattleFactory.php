<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Battle;

$factory->define(Battle::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'description' => $faker->text(10),
        'gap' => $faker->biasedNumberBetween(1,2),
        'rounds' => $faker->biasedNumberBetween(5,10),
//        'start_date' => $faker->date(),
        'start_date' => \Carbon\Carbon::now(),
        'end_date' => $faker->date(),
        'video_options' => json_encode([$faker->title => $faker->firstName]),
//        'category_id' => $faker->biasedNumberBetween(5,10),
        'views' => $faker->text(10),
        'category_id' => factory(\App\Category::class)->create()->id,

    ];
});
