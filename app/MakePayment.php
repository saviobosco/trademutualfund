<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class MakePayment extends Model
{
    CONST CONFIRMED = 3;
    CONST MERED_OUT = 2;
    CONST CANCELLED = -1;
    CONST ACTIVE = 1;

    protected $guarded = ['id'];

    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function isActive()
    {
        return (int) $this->status === static::ACTIVE;
    }

    public function isMerged()
    {
        return (int) $this->status === static::MERED_OUT;
    }

    public function hasPaidAll()
    {
        return (float) $this->initial_amount === (float) $this->amount_paid;
    }

    public function cancel()
    {
        // get all transactions and cancel it
        $transactions = Transaction::query()->where([
            ['make_payment_id'=> $this->id],
            ['status' => Transaction::ACTIVE]
        ])->get();
        if (count($transactions)) {
            foreach($transactions as $transaction) {
                $transaction->cancel();
            }
        }
        $this->update(['status' => static::CANCELLED ]);
    }

    public function updateAmountPaid($data)
    {
        $this->amount_paid += $data['amount_paid'];
        if($this->update()) {
            if($this->isMerged() && $this->hasPaidAll()) {
                $this->confirm();
                if ($investment = $this->investment()->first()) {
                    $investment->confirm();
                }
                try {
                    $referralAncestors = ReferralPyramid::defaultOrder()->ancestorsOf($this->user_id);
                    $referralAncestorsCount = count($referralAncestors);
                    if ($referralAncestorsCount >= 1) {
                        $parentReferral = (isset($referralAncestors[$referralAncestorsCount - 1])) ? $referralAncestors[$referralAncestorsCount - 1] : null ;
                        if ($parentReferral) {
                            $parentReferralUser = User::find($parentReferral['user_id']);
                            $parentReferralUser->getReferralCredit( $this->initial_amount * (5 / 100) ,$this->user_id );
                        }
                        $grandParentReferral = (isset($referralAncestors[$referralAncestorsCount - 2])) ? $referralAncestors[$referralAncestorsCount - 2] : null ;
                        if ($grandParentReferral) {
                            $grandParentReferralUser = User::find($grandParentReferral['user_id']);
                            $grandParentReferralUser->getReferralCredit( $this->initial_amount * (2 / 100) ,$this->user_id );
                        }
                    }
                } catch ( \Exception $exception ) {
                    // sub due error
                }
            }
            return true;
        }
    }

    public function confirm()
    {
        return $this->update([
            'status' => static::CONFIRMED,
            'completed_at' => new Carbon()
        ]);
    }

}
