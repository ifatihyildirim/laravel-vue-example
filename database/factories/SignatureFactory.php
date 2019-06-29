<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Signature;
use Faker\Generator as Faker;

$factory->define(Signature::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'body' => $faker->sentence
    ];
});
