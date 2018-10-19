<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 10/18/18
 * Time: 5:49 AM
 */

namespace App;


trait MustVerifyPhone
{
    /**
     * Determine if the user has verified their phone number.
     *
     * @return bool
     */
    public function hasVerifiedPhone()
    {
        return ! is_null($this->phone_verified_at);
    }

    /**
     * Mark the given user's phone as verified.
     *
     * @return bool
     */
    public function markPhoneAsVerified()
    {
        return $this->forceFill([
            'phone_verified_at' => $this->freshTimestamp(),
        ])->save();
    }

    /**
     * Send the phone verification notification.
     *
     * @return void
     */
    public function sendPhoneVerificationNotification()
    {
        //$this->notify(new Notifications\VerifyEmail);
    }
}