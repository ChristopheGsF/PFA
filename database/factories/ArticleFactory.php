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
        'brand' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'model' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'price' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'color' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'release' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'brand_img' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'content' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'brand_img' => $faker->imageUrl($width = 1920, $height = 1080),
      'content' => $faker->text,
      'img' => $faker->imageUrl($width = 1920, $height = 1080),
      'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
