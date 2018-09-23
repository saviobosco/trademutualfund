<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;


class ReferralLink extends Model
{
    //
    protected $fillable = ['user_id'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function (ReferralLink $model) {
            $model->generateCode();
        });
    }

    private function generateCode()
    {
        $this->code = (string)Uuid::uuid1();
    }

    public static function getReferral($user)
    {
        return static::firstOrCreate([
            'user_id' => $user->id,
        ]);
    }

    public function getLinkAttribute()
    {
        return url('register') . '?ref=' . $this->code;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function relationships()
    {
        return $this->hasMany(ReferralRelationship::class);
    }
}
