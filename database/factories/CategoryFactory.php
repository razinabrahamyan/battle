<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Category;

$factory->define(Category::class, function (Faker $faker) {
    return [
//        'id' => factory(\App\Battle::class)->create()->category_id,
        'base_id' => $faker->biasedNumberBetween(1,10),
        'title' => ['en' => $faker->colorName ],
        'description' => ['en' => $faker->colorName ],
        'image' => 'image.png'

    ];
});
