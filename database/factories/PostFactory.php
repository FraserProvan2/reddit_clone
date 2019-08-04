<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use App\SubReddit;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $user = User::latest()->first();
    $sub_reddit = SubReddit::latest()->first();

    return [
        'user_id' => $user->id,
        'sub_reddit_id' => $sub_reddit->id,
        'title' => $faker->sentence(9),
        'body' => $faker->sentence(40)
    ];
});
