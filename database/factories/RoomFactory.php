<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Room;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(Room::class, function (Faker $faker) {
    $city_ids = DB::table('cities')->pluck('id')->toArray();
    $city_key = array_rand($city_ids);
    $city_id = $city_ids[$city_key];

    $place_ids = DB::table('places')->where('city_id', $city_id)->pluck('id')->toArray();
    $place_key = array_rand($place_ids);
    $place_id = $place_ids[$place_key];

    $category_ids = DB::table('categories')->pluck('id');

    return [
        'title' => $faker->sentence( 6, true),
        'city_id' => $city_id,
        'place_id' => $place_id,
        'price' => $faker->numberBetween($min = 3000, $max = 10000),
        'user_id' => rand(2,3),
        'total_rooms' => $faker->randomDigitNotNull,
        'category_id' => $faker->randomElement($category_ids),
        'description' => $faker->text(200)
    ];
});
