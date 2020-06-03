<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Agent;
use Faker\Generator as Faker;

$factory->define(Agent::class, function (Faker $faker) {
    $jobTitle = 'Real Estate Agent';
    return [
        'user_id' => null,
        /**'title' => $faker->jobTitle,*/
        'title' => $jobTitle,
        'biography' => $faker->paragraph
    ];
});
