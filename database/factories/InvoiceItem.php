<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Invoice;
use App\InvoiceItem;
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

$factory->define(InvoiceItem::class, function (Faker $faker) {
    return [
        'invoice_id' => function () {
            return factory(Invoice::class)->create()->id;
        },
        'quantity' => $faker->randomDigit,
        'unit_price' => $this->faker->randomNumber(),
        'amount' => $this->faker->randomNumber(),
        'description' => $this->faker->sentence(),
    ];
});
