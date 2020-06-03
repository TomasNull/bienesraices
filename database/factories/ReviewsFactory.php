<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reviews;
use Faker\Generator as Faker;

$factory->define(Reviews::class, function (Faker $faker) {
    return [
        'real_estate_id' => \App\RealEstate::all()->random()->id,
        'rating' => $faker->randomFloat(2, 1, 5) //número flotante, 2 decimales; valor mínimo 1, valor máximo 5
    ];
});
