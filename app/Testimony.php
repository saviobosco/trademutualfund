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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
