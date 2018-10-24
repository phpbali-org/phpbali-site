<?php

use Faker\Generator as Faker;
use Carbon\Carbon;

$factory->define(App\Models\Event::class, function (Faker $faker) {
    $name = $faker->name;
    $slug = str_slug($name, '-');

    $startDate = Carbon::instance($faker->dateTimeBetween(sprintf("-%d days", $faker->numberBetween(1, 30))));
    $endDate = $startDate->addHours($faker->numberBetween(1, 5));

    return [
        'slug' => $slug,
        'name' => $name,
        'desc' => $faker->sentence,
        'start_date' => $startDate,
        'end_date' => $endDate,
        'place' => $faker->streetAddress,
        'place_name' => $faker->streetName,
        'latitude' => $faker->latitude,
        'longitude' => $faker->longitude,
        'published' => $faker->boolean,
    ];
});
