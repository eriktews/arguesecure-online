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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Tree::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'is_public' => $faker->boolean
    ];
});

$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'description' => str_slug($faker->word),
        'color' => $faker->color
    ];
});

$factory->define(App\Risk::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->word,
        'text' => $faker->paragraph
    ];
});