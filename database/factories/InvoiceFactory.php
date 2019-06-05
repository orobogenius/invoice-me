<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Invoice;
use App\Customer;
use Illuminate\Support\Str;
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

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'user_id' => function() {
          return factory(User::class)->create()->id;
         },
        'customer_id' => function() {
          return factory(Customer::class)->create()->id;
         },
        'number' => Str::random(10),
        'reference' => Str::random(10),
        'amount' => $this->faker->randomNumber(),
        'description' => $this->faker->sentence()        
    ];
});
