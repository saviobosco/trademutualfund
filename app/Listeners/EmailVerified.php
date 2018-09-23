<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Verified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailVerified
{

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Verified  $event
     * @return void
     */
    public function handle(Verified $event)
    {
        activity()
            ->performedOn($event->user)
            ->causedBy($event->user)
            ->withProperties(['Type' => "Email Verification"])
            ->log("Email verified");
    }
}
