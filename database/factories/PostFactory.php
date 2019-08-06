<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use App\Topic;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $user = User::orderBy('id', 'desc')->first();
    $topic = Topic::orderBy('id', 'desc')->first();
    
    return [
        'user_id' => $user->id,
        'topic_id' => $topic->id,
        'title' => $faker->sentence(9),
        'body' => $faker->sentence(40),
        'votes' => $faker->numberBetween(0, 1200)
    ];
});
