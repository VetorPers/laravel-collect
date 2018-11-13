<?php

use Faker\Generator as Faker;
use Vetor\Tests\Collect\Stubs\Models\Article;

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Article::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
