<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserPaymentDetails extends Model
{
    protected $guarded = ['id'];

    public function bank()
    {
        return $this->hasOne(Bank::class, 'id', 'bank_id');
    }
}
