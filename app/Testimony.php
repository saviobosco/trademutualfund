<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    protected $guarded = ['id'];

    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }
}
