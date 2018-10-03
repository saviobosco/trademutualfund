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
                    $directReferral = $this->user->referredByUser();
                    $directReferralBonus = $this->initial_amount * (5 / 100);
                    $directReferral->getReferralCredit($directReferralBonus,$this->user_id );

                    $indirectReferral = $directReferral->referredByUser();
                    $indirectReferralBonus = $this->initial_amount * (2 / 100);
                    $indirectReferral->getReferralCredit($indirectReferralBonus,$this->user_id );
                } catch (ModelNotFoundException $exception) {
                    //sub due error
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
