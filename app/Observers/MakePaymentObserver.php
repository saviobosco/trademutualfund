<?php

namespace App\Observers;

use App\MakePayment;

class MakePaymentObserver
{
    /**
     * Handle the make payment "created" event.
     *
     * @param  \App\MakePayment  $makePayment
     * @return void
     */
    public function created(MakePayment $makePayment)
    {
        //
    }

    /**
     * Handle the make payment "updated" event.
     *
     * @param  \App\MakePayment  $makePayment
     * @return void
     */
    public function updated(MakePayment $makePayment)
    {
        /*if ($makePayment->isActive() && $makePayment->hasPaidAll()) {
            if ($investment = $makePayment->investment()->first()) {
                $investment->confirm();
            }
        }*/
    }

    /**
     * Handle the make payment "deleted" event.
     *
     * @param  \App\MakePayment  $makePayment
     * @return void
     */
    public function deleted(MakePayment $makePayment)
    {
        //
    }

    /**
     * Handle the make payment "restored" event.
     *
     * @param  \App\MakePayment  $makePayment
     * @return void
     */
    public function restored(MakePayment $makePayment)
    {
        //
    }

    /**
     * Handle the make payment "force deleted" event.
     *
     * @param  \App\MakePayment  $makePayment
     * @return void
     */
    public function forceDeleted(MakePayment $makePayment)
    {
        //
    }
}
