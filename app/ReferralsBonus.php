<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralsBonus extends Model
{
    CONST PAID_OUT = 2;

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

    public function paidOut()
    {
        return $this->update(['status' => static::PAID_OUT]);
    }
}
