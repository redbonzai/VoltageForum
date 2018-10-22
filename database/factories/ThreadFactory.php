<?php

use App\Models\Channel;
use App\Models\User;
use Faker\Generator as Faker;
use App\Models\Thread;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return factory(User::class)->create()->id;
        },
        'channel_id' => function() {
            return factory(Channel::class)->create()->id;
        },
        'title' => $faker->sentence,
        'body' => $faker->paragraph
    ];
});
