<?php

use Faker\Generator as Faker;
use Vetor\Tests\Collect\Stubs\Models\User;

/* @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
