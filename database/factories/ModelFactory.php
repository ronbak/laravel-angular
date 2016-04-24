<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(LaravelAngular\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(LaravelAngular\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'responsible' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'obs' => $faker->sentence,
    ];
});

$factory->define(LaravelAngular\Entities\Project::class, function (Faker\Generator $faker) {
    return [
        //'owner_id' => $faker->randomElement(\LaravelAngular\Entities\User::all('id')),
        //'client_id' => $faker->randomElement(\LaravelAngular\Entities\Client::all('id')),
        'owner_id' => $faker->numberBetween(1,2),
        'client_id' => $faker->numberBetween(1,5),
        'name' => $faker->name,
        'description' => $faker->text(),
        'progress' => $faker->numberBetween(0,100),
        'status' => $faker->numberBetween(0,1),
        'due_date' => $faker->dateTime,
    ];
});
