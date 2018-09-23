<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralsBonus extends Model
{
    protected $table = 'referrals_bonuses';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();
        static::created(function($model) {
            activity()
                ->performedOn($model)
                ->causedBy($model->user)
                ->withProperties(['Type' => "Referral Bonus received"])
                ->log("{$model->amount} referral bonus received from {$model->referred_user->name}.");
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function referred_user()
    {
        return $this->belongsTo(User::class,'referred_user_id');
    }
}
