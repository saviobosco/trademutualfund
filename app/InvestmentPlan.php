<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvestmentPlan extends Model
{
    protected $fillable = ['name', 'minimum_amount', 'maximum_amount'];

    public function investment_rules()
    {
        return $this->belongsToMany(InvestmentRule::class, 'investment_plan_rules');
    }

    public function getInvestmentRules()
    {
        return $this->investment_rules()->get()->all();
    }
}
