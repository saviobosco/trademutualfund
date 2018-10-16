<?php

namespace App\Listeners;

use App\ReferralLink;
use App\ReferralPyramid;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\ReferralRelationship;

class RegisteredEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Registered  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $userReferral = $this->getReferralUser($event->user);
        if ($userReferral instanceof Model) {
            $this->registerReferral($userReferral, $event->user);
        } else {
            // Register the user as a parent referral
            ReferralPyramid::create([
                'user_id' => $event->user->id,
                'name' => $event->user->name
            ]);
        }
    }

    protected function getOwnerOfRefCode($referral_id)
    {
        $referral = ReferralLink::query()->select(['user_id'])->with(['user:id,name'])->where('id',$referral_id)->first();
        return $referral->user;
    }

    protected function getReferralUser($registeredUser)
    {
        if ($user = $this->getReferralByEmail()) {
            return $user;
        }
        if ($user = $this->getReferralByCookie($registeredUser)) {
            return $user;
        }
        return false;
    }

    protected function getReferralByEmail()
    {
        $referralEmail = request()->input('referral_email');
        if (empty($referralEmail)) {
            return false;
        }
        $user = User::query()->where('email', 'like', trim($referralEmail))->first();
        if ($user) {
            return $user;
        }
        return false;
    }

    protected function getReferralByCookie($registeredUser)
    {
        $refId = request()->cookie('ref');
        if ($refId) {
            ReferralRelationship::create(['referral_link_id' => $refId, 'user_id' => $registeredUser->id]);
            // find the user who referred
            $user = $this->getOwnerOfRefCode($refId);
            return $user;
        }
        return false;
    }

    protected function registerReferral($userReferredBy, $registeredUser)
    {
        try {
            $parent = ReferralPyramid::findorFail($userReferredBy['id']);
        } catch ( ModelNotFoundException $exception ) {
            $parent = ReferralPyramid::create([
                'user_id' => $userReferredBy['id'],
                'name' => $userReferredBy['name']
            ]);
        }
        $child = ReferralPyramid::create([
            'user_id' => $registeredUser->id,
            'name' => $registeredUser->name
        ]);
        $parent->appendNode($child);
    }
}
