<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Investment
 * @package App
 * @property int $status
 */
class Investment extends Model
{
    CONST CANCELLED = -1;
    CONST ACTIVE = 1;
    CONST CONFIRMED = 2;
    CONST CASH_OUT = 3;
    CONST CASHED_OUT = 4; // when investment has been be cashed out
    CONST COMPLETED = 5; // when the transaction is complete

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
            $makePayment = $this->make_payments()->get()[0];
            $makePayment->cancel();
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

    public function isConfirmed()
    {
        return (int) $this->status === static::CONFIRMED;
    }

    public function confirm()
    {
        return $this->update(['status' => static::CONFIRMED]);
    }

    public function complete()
    {
        if (! $this->isCashedOut()) {
            return false;
        }
        return $this->update(['status' => static::COMPLETED]);
    }

    public function cashOut()
    {
        return $this->update(['status' => static::CASH_OUT]);
    }

    public function isCashAble()
    {
        return (int)$this->status === static::CASH_OUT;
    }

    public function cashOutInvestment()
    {
        // get all active referral bonuses
        $referrals = ReferralsBonus::query()
            ->where('status',1)
            ->where('user_id', $this->user_id)
            ->get();
        // sum all
        $referralsSum = $referrals->sum('amount');
        // change status as paid out
        $data = [
            'user_id' => $this->user_id,
            'investment_id' => $this->id,
            'amount' => $this->roi_amount + $referralsSum,
            'initial_amount' => $this->roi_amount + $referralsSum,
        ];
        if (GetPayment::create($data)) {
            if ($this->global_funds_amount) {
                GlobalFund::create([
                    'investment_id' => $this->id,
                    'amount' => $this->global_funds_amount
                ]);
            }
            foreach($referrals as $referral) {
                $referral->paidOut();
            }
            $global_funds = setting('global_funds');
            $global_funds_cumulative = setting('global_funds_cumulative');
            $global_funds += $this->global_funds_amount;
            $global_funds_cumulative += $this->global_funds_amount;
            setting(['global_funds' => $global_funds]);
            setting(['global_funds_cumulative' => $global_funds_cumulative]);
            setting()->save();
            $this->cashedOut();
            return true;
        }
        return false;
    }

    public function cashedOut()
    {
        return $this->update(['status' => static::CASHED_OUT]);
    }

    public function isCashedOut()
    {
        return (int)$this->status === static::CASHED_OUT;
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
