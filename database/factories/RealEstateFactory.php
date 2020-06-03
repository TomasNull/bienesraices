<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RealEstate;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(RealEstate::class, function (Faker $faker) {
    $name = $faker->sentence;
    $status = $faker->randomElement([\App\RealEstate::PUBLISHED, \App\RealEstate::PENDING, \App\RealEstate::REJECTED]);
    $status_estate = $faker->randomElement([\App\RealEstate::PUBLISHED, \App\RealEstate::PENDING, \App\RealEstate::REJECTED]);

    return [
        'agent_id' => \App\Agent::all()->random()->id, //busca dentro de la tabla el id y lo devuelve
        'category_id' => \App\Category::all()->random()->id, //busca dentro de la tabla el id y lo devuelve
        'status_estate' => $status_estate,
        'name' => $name,
        'description' => $faker->paragraph,
        'address' => $faker->address,
        'city' => $faker->city,
        'country' => $faker->country,
        'price' => $faker->randomFloat(2, 50000, 300000),
        'bedrooms' => $faker->numberBetween(1, 4),
        'bathrooms' => $faker->numberBetween(1, 3),
        'yard' => 'category_id' !== 3 ? true : false,
        'pool' => $faker->randomElement($array = array(0, 1)),
        'garage' => $faker->randomElement($array = array(0, 1)),
        'new_construct' => $faker->randomElement($array = array(0, 1)),
        'slug' => Str::slug($name, '-'),
        'picture' => \Faker\Provider\Image::image(storage_path() . '/app/public/realestates', 1920, 919, 'people', false),
        'status' => $status,
        'previous_approved' => $status !== \App\RealEstate::PUBLISHED ? false : true,
        'previous_rejected' => $status !== \App\RealEstate::REJECTED ? true : false
    ];
});
