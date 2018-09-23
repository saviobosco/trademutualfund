<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralRelationship extends Model
{
    //
    protected $fillable = ['referral_link_id', 'user_id'];

    public function referral_link()
    {
        return $this->belongsTo(ReferralLink::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
