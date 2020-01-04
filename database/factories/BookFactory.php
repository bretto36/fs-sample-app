<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use App\Enums\BookStatus;
use Faker\Generator as Faker;

$factory->define(Book::class, function (Faker $faker) {
    $sentence = $faker->sentence(rand(1, 4));
    
    return [
        'title' => substr($sentence, 0, strlen($sentence) - 1),
        'author' => $faker->name,
        'blurb' => $faker->text(100),
        'status' => BookStatus::getRandomKey()
    ];
});
