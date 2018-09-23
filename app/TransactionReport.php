<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionReport extends Model
{
    protected $guarded = ['id'];

    public function resolved()
    {
        $this->update(['status' => 2]);
    }
}
