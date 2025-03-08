<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email_address' => $faker->email,
        'paypal_email_address' => $faker->email,
        'username' => $faker->userName,
        'password' => Hash::make(Str::random(6)),
        'profile' => 'images/2020/06/26/Z4EZtnMl7npXegW6Juk5fJmTHYitppS712HBf2Qt.jpeg',
    ];
});
