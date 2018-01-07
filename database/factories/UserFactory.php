<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'first_name' => $faker->FirstName,
        'last_name' => $faker->LastName,
        'username' => $faker->username,
        'email' => $faker->unique()->safeEmail,
        'ip' => $faker->ipv4,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'slug' => str_slug($faker->name)
    ];
});

$factory->define(App\Comment::class, function ($faker) {
    return [
        'body' => $faker->paragraph,
        'user_id' => factory(App\User::class)->create()->id,
        'commentable_id' => 1,
        'commentable_type' => 'App\Article'
    ];
});

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'slug'  => str_slug($faker->sentence),
        'body'  => $faker->text,
        'user_id' => factory(App\User::class)->create()->id,
        'category_id' => factory(App\Category::class)->create()->id
    ];
});

$factory->define(App\ForumCategory::class, function ($faker) {
    return [
        'name' => $faker->sentence
    ];
});

$factory->define(App\Forum::class, function ($faker) {
    return [
        'name' => $faker->sentence,
        'slug' => $faker->slug,
        'description' => $faker->paragraph,
        'category_id' => 1
    ];
});

$factory->define(App\Topic::class, function ($faker) {
    $title = $faker->sentence;
    return [
        'title' => $title,
        'slug' => preg_replace(['/\s+/', '/(-{2,})/'], ['-', '-'], $title),
        'body' => $faker->text,
        'user_id' => 1,
        'forum_id' => 1
    ];
});
