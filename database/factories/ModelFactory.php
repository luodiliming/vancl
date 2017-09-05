<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});



//在这里创建多条用户和密码的方法！    找到\App\Admin\Admin_login 类    这里会提供一种方式，会填充多条用户和密码！填充好内容后 到 mysql运行命令：php artisan tinker
$factory->define(\App\Admin\Admin_login::class, function (Faker\Generator $faker) {
    static $password;
    return [
        'username' => $faker->name,
        'password' => $password ?: $password = bcrypt('123456'),
    ];
});
