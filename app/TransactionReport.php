<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionReport extends Model
{
    CONST STATUS_ACTIVE = 1;
    CONST STATUS_RESOLVED = 2;

    protected $guarded = ['id'];

    public function resolved()
    {
        $this->update(['status' => static::STATUS_RESOLVED]);
    }
}
