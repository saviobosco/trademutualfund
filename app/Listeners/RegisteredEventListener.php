<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Registered;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

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
        //handle the user registered event
        // do anything with the user data
        $refId = request()->cookie('ref');
        if ($refId) {
            $referral = \App\ReferralLink::find($refId);
            if (!is_null($referral)) {
                \App\ReferralRelationship::create(['referral_link_id' => $referral->id, 'user_id' => $event->user->id]);
            }
        }
    }
}
