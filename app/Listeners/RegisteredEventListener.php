<?php

namespace App\Listeners;

use App\ReferralLink;
use App\ReferralPyramid;
use App\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        $refId = request()->cookie('ref');
        if ($refId) {
            \App\ReferralRelationship::create(['referral_link_id' => $refId, 'user_id' => $event->user->id]);
            // find the user who referred
            $user = $this->getOwnerOfRefCode($refId);
            // get the user in the referral_pyramid table
            try {
                $parent = ReferralPyramid::findorFail($user['id']);
            } catch ( ModelNotFoundException $exception ) {
                $parent = ReferralPyramid::create([
                    'user_id' => $user['id'],
                    'name' => $user['name']
                ]);
                $parent->save();
            }
            $child = ReferralPyramid::create([
                'user_id' => $event->user->id,
                'name' => $event->user->name
            ]);
            $child->save();
            $parent->appendNode($child);
        }
    }

    protected function getOwnerOfRefCode($referral_id)
    {
        $referral = ReferralLink::query()->select(['user_id'])->with(['user:id,name'])->where('id',$referral_id)->first();
        return $referral->user;
    }
}
