<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Owner;
use Faker\Generator as Faker;

$factory->define(Owner::class, function (Faker $faker) {
    return [
        'name' => 'Mr. Owner 1',
        'email' => 'owner1@mail.com',
        'password' => bcrypt('password'),
        'role' => 1,
        'email_verified_at' => \Carbon\Carbon::now()
    ];
});
