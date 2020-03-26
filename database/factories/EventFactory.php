<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Event;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'slug' => Str::slug($faker->name, '-'),
        'name' => $faker->name,
        'desc' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'place_name' => $faker->address,
        'published' => '0', // default: 0 (not published), 1 (published)
        'start_datetime' => $faker->dateTime($max = 'now', $timezone = null),
        'end_datetime' => $faker->dateTime($max = 'now', $timezone = null),
        'address' => $faker->address,
    ];
});
