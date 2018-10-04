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
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\InvestmentPlan::class, function() {
    return [
        'name' => 'Standard',
        'minimum_amount' => '20000',
        'maximum_amount' => '300000',
    ];
});

$factory->define(App\InvestmentRule::class, function() {
    return [
        'duration' => '7 Days',
        'investment_percentage' => '20',
        'global_percentage' => '10',
    ];
});

$factory->define(App\Investment::class, function() {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'get_payment_id' => null,
        'make_payment_id' => null,
        'investment_plan_id' => 1,
        'amount_invested' => 50000,
        'release_date' => new \Carbon\Carbon()
    ];
});

$factory->define(App\MakePayment::class, function() {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'investment_id' => function() {
            return factory('App\Investment')->create()->id;
        },
        'amount' => 50000,
        'initial_amount' => 50000,
    ];
});

$factory->define(App\GetPayment::class, function() {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'investment_id' =>null,
        'amount' => 50000,
        'initial_amount' => 50000,
    ];
});

$factory->define(App\Transaction::class, function() {
    return [
        'make_payment_user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'get_payment_user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'get_payment_id' => null,
        'make_payment_id' => null,
        'amount' => 50000,
        'time_elapse_after' => function(){ return new \Carbon\Carbon('+12 Hours');},
    ];
});

$factory->define(App\PhotoProof::class, function() {
   return [
       'transaction_id' => null,
       'photo_name' => 'proof.jpg',
   ];
});

$factory->define(App\TransactionReport::class, function() {
    return [
        'transaction_id' => null,
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
    ];
});

$factory->define(App\UserSetting::class, function() {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
    ];
});

$factory->define(App\Testimony::class, function(Faker $faker) {
    return [
        'user_id' => function() {
            return factory('App\User')->create()->id;
        },
        'testimony' => $faker->paragraph()
    ];
});
