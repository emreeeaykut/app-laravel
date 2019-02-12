<?php

use Faker\Generator as Faker;


$factory->define(App\Work::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'main_img' => $faker->imageUrl(),
        'detail' => str_random(10),
        'iframe1' => '1111', 
        'iframe2' => '2222',
        'created_at' => now(),
        'updated_at' => now(),
    ];
});