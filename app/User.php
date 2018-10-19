<?php

namespace App;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable,HasRoles,MustVerifyPhone;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone_number','country_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot() {
        parent::boot();
        static::created(function ($user) {
            $user->user_payment_details()->create();
            $user->referral_link()->create();
            $user->user_setting()->create();
            activity()
                ->performedOn($user)
                ->causedBy($user)
                ->withProperties(['Type' => "User Registration"])
                ->log("User joined the platform");
        });

        static::deleting(function($user) { // before delete() method call this
            $user->user_payment_details()->delete();
            $user->referral_link()->delete();
            $user->user_setting()->delete();
            // do the rest of the cleanup...
        });
    }

    public function country()
    {
        return $this->belongsTo(Countries::class);
    }

    public function user_payment_details()
    {
        return $this->hasOne(UserPaymentDetails::class);
    }

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    public function testimonies()
    {
        return $this->hasMany(Testimony::class);
    }

    public function referral_link()
    {
        return $this->HasOne(ReferralLink::class);
    }

    public function user_setting()
    {
        return $this->hasOne(UserSetting::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function referral_relationship()
    {
        return $this->hasOne(ReferralRelationship::class);
    }

    public function referredByUser()
    {
        $user = User::query()->with(['referral_relationship.referral_link.user'])->where('users.id',$this->id)->first();
        if (is_null($user->referral_relationship)) {
            throw new ModelNotFoundException;
        }
        return $user->referral_relationship->referral_link->user;
    }

    public function usersReferred()
    {
        $referrals = $this->referral_link()->with(['relationships.user'])->get()->toArray();
        return $referrals[0]['relationships'];
    }

    public function getInvestments()
    {
        return $this->investments()->with(['testimony'])->get();
    }

    public function getReferralCredit($amount,$referred_user_id)
    {
        return ReferralsBonus::create([
            'user_id' => $this->id,
            'amount' => $amount,
            'referred_user_id' => $referred_user_id
        ]);
    }

    public function addTestimony($testimony)
    {
        return $this->testimonies()->create([
            'testimony' => $testimony
        ]);
    }
}
