<?php

use App\Blog;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Blog::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'body' => $faker->text(500),
    ];
});
