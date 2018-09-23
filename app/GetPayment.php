<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class GetPayment extends Model
{
    CONST STATUS_ACTIVE = 1;
    CONST STATUS_CANCELLED = -1;
    CONST STATUS_MERGED = 2;
    CONST STATUS_CONFIRM = 3;
    //

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }

    public function confirm()
    {
        $this->update([
            'status' => static::STATUS_CONFIRM,
            'completed_at' => new Carbon()
        ]);
    }

    public function isMerged()
    {
        return $this->status === static::STATUS_MERGED;
    }

    public function hasReceivedAll()
    {
        return (float) $this->initial_amount === (float) $this->amount_paid;
    }

    public function updateAmountPaid($data)
    {
        $this->amount_paid += $data['amount_paid'];
        if($this->update()) {
            if($this->isMerged() && $this->hasReceivedAll()) {
                $this->confirm();
                if ($investment = $this->investment()->first()) {
                    $investment->complete();
                }
            }
            return true;
        }
    }
}
