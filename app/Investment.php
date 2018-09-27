<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    CONST CANCELLED = -1;
    CONST ACTIVE = 1;
    CONST CONFIRMED = 2;
    CONST MERGED = 3; // when a get payment record has been created
    CONST COMPLETED = 4; // when the transaction is complete

    protected $fillable = ['user_id','make_payment_id','investment_plan_id','global_funds_amount','amount_invested','roi_amount','','release_date','status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function make_payments()
    {
        return $this->hasMany(MakePayment::class);
    }

    public function get_payment()
    {
        return $this->hasOne(GetPayment::class);
    }

    public function cancel()
    {
        if ($this->canCancel() && $this->isActive()) {
            return $this->update(['status' => static::CANCELLED]);
        }
        return false;
    }

    public function canCancel()
    {
        $makePayment = $this->make_payments()->get();
        if ($makePayment->count() <= 0) {
            return true;
        }
        return $this->amount_invested === $makePayment[0]['amount'];
    }

    public function isActive()
    {
        return (int)$this->status === static::ACTIVE;
    }

    public function confirm()
    {
        return $this->update(['status' => static::CONFIRMED]);
    }

    public function complete()
    {
        return $this->update(['status' => static::COMPLETED]);
    }

    public function merged()
    {
        return $this->update(['status' => static::MERGED]);
    }

    public function isMerged()
    {
        return $this->status === static::MERGED;
    }

    public function testimony()
    {
        return $this->hasOne(Testimony::class);
    }

    public function addTestimony($testimony)
    {
        return $this->testimony()->create([
            'user_id' => $this->user_id,
            'testimony' => $testimony
        ]);
    }
}
