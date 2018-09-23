<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvestmentRule extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'duration', 'investment_percentage', 'global_percentage'
    ];

    public function investment_plans()
    {
        return $this->belongsToMany(InvestmentPlan::class, 'investment_plan_rules');
    }
}
