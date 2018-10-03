<?php

use Illuminate\Database\Seeder;

class InvestmentPlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\InvestmentPlan::create([
            'name' => 'Standard',
            'minimum_amount' => '50000',
            'maximum_amount' => '100000'
        ]);
        \App\InvestmentPlan::create([
            'name' => 'Silver',
            'minimum_amount' => '100000',
            'maximum_amount' => '500000'
        ]);
        \App\InvestmentPlan::create([
            'name' => 'Gold',
            'minimum_amount' => '500000',
            'maximum_amount' => '1000000'
        ]);
        \App\InvestmentPlan::create([
            'name' => 'Platinum',
            'minimum_amount' => '1000000',
            'maximum_amount' => '10000000'
        ]);
        $pivotTable = DB::table('investment_plan_rules');
        $pivotTable->insert(['investment_plan_id' => 1, 'investment_rule_id' => 1 ]);
        $pivotTable->insert(['investment_plan_id' => 2, 'investment_rule_id' => 1 ]);
        $pivotTable->insert(['investment_plan_id' => 2, 'investment_rule_id' => 2 ]);
        $pivotTable->insert(['investment_plan_id' => 3, 'investment_rule_id' => 1 ]);
        $pivotTable->insert(['investment_plan_id' => 3, 'investment_rule_id' => 2 ]);
        $pivotTable->insert(['investment_plan_id' => 3, 'investment_rule_id' => 3 ]);

        $pivotTable->insert(['investment_plan_id' => 4, 'investment_rule_id' => 1 ]);
        $pivotTable->insert(['investment_plan_id' => 4, 'investment_rule_id' => 2 ]);
        $pivotTable->insert(['investment_plan_id' => 4, 'investment_rule_id' => 3 ]);
    }
}
