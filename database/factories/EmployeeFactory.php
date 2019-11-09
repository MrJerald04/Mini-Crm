<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'country_id' => $faker->numberBetween($min = 1, $max = 244),
        'last_name' => $faker->lastName,
        'first_name' => $faker->firstName,
        'company_id' => $faker->numberBetween($min = 1, $max = 99),
        'email' => $faker->unique()->safeEmail,
        'password' => bcrypt('password'),
        'phone' => $faker->e164PhoneNumber
    ];
});
