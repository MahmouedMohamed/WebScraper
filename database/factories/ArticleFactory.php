<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'website_id' => factory(\App\Website::class),
        'title' =>$faker->sentence,
        'description' =>$faker->paragraph,
    ];
});
