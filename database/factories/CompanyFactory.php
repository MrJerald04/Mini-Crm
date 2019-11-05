<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'country_id' => $faker->numberBetween($min = 1, $max = 244),
        'name' => $faker->company,
        'email' => $faker->unique()->companyEmail,
        'logo' => 'noimage.png',
        'website' => $faker->domainName,
        'color' => $faker->hexcolor,
    ];
});
