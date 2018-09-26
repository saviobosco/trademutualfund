<?php

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

