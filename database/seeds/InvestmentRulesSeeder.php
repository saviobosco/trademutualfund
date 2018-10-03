<?php

use Illuminate\Database\Seeder;

class InvestmentRulesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\InvestmentRule::create([
            'duration' => '7 Days',
            'investment_percentage' => '20',
            'global_percentage' => '10',
        ]);
        \App\InvestmentRule::create([
            'duration' => '30 Days',
            'investment_percentage' => '90',
            'global_percentage' => '30',
        ]);
        \App\InvestmentRule::create([
            'duration' => '60 Days',
            'investment_percentage' => '180',
            'global_percentage' => '60',
        ]);
    }
}
