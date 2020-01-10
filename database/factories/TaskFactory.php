<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title'   => $faker->name,
        'body'    => $faker->text,
        'user_id' => 1,
    ];
});
