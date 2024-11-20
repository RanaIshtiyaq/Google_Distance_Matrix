<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'address' => $faker->address,
        // Add other fields based on your Company model
    ];
});
