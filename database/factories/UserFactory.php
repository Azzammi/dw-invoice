<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User; use App\Product; use App\Customer;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Product::class, function (Faker $faker){
    return [
        'title' => $faker->unique()->domainName,
        'description' => $faker->catchphrase,
        'price' => $faker->numberBetween(500000,10000000),
        'stock' => $faker->numberBetween(1,20),
    ];
});

$factory->define(Customer::class, function (Faker $faker){
    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->email
    ];
});
