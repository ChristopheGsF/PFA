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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Article::class, function (Faker\Generator $faker) {
    return [
      'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
      'content' => $faker->text,
      'img' => $faker->imageUrl($width = 1000, $height = 500),
      'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
