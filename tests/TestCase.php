<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\DB;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;


    public function setUp()
    {
        parent::setUp();
        //$this->makeInvestmentPlans();
    }

    public function signIn($user = null)
    {
        if ($user === null) {
            $this->be(factory('App\User')->create());
            return;
        }
        $this->be($user);
    }

    public function makeInvestmentPlans()
    {
        $this->makeInvestmentRules();
        factory('App\InvestmentPlan')->create();
        factory('App\InvestmentPlan')->create([
            'name' => 'Silver',
            'minimum_amount' => '300000',
            'maximum_amount' => '1000000'
        ]);
        factory('App\InvestmentPlan')->create([
            'name' => 'Gold',
            'minimum_amount' => '1000000',
            'maximum_amount' => '5000000'
        ]);
        factory('App\InvestmentPlan')->create([
            'name' => 'Platinum',
            'minimum_amount' => '5000000',
            'maximum_amount' => '10000000'
        ]);
        /*$pivotTable = DB::table('investment_plan_rules');
        $pivotTable->insert(['investment_plan_id' => 1, 'investment_rule_id' => 1 ]);
        $pivotTable->insert(['investment_plan_id' => 2, 'investment_rule_id' => 1 ]);
        $pivotTable->insert(['investment_plan_id' => 2, 'investment_rule_id' => 2 ]);
        $pivotTable->insert(['investment_plan_id' => 3, 'investment_rule_id' => 1 ]);
        $pivotTable->insert(['investment_plan_id' => 3, 'investment_rule_id' => 2 ]);
        $pivotTable->insert(['investment_plan_id' => 3, 'investment_rule_id' => 3 ]);*/
    }

    public function makeInvestmentRules()
    {
        factory('App\InvestmentRule')->create();
        factory('App\InvestmentRule')->create([
            'duration' => '30 Days',
            'investment_percentage' => '90',
            'global_percentage' => '30',
        ]);
        factory('App\InvestmentRule')->create([
            'duration' => '60 Days',
            'investment_percentage' => '180',
            'global_percentage' => '60',
        ]);
    }
}
