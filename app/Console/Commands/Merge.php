<?php

namespace App\Console\Commands;

use App\GetPayment;
use App\MakePayment;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Console\Command;

class Merge extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'merge:payment';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = ' Merge Payments';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (! setting('merge_status')) {
            return;
        }
        // get all get payments
        $getPayments = GetPayment::query()->where('status', 1)->get()->toArray();
        // if get payment request is empty exit
        if (count($getPayments) <= 0) {
            return;
        }
        while(count($getPayments) > 0) {
            $makePayments = MakePayment::query()->where('status', 1)->get();
            if (count($makePayments) <= 0) {
                break;
            }
            $getPayment = array_shift($getPayments);

            $transaction = [
                'time_elapse_after' => new Carbon(setting('transaction_time'))
            ];

            foreach($makePayments as $makePayment) {
                if ($getPayment['amount'] <= 0) {
                    break;
                }
                if ($getPayment['user_id'] === $makePayment['user_id']) {
                    continue;
                }
                if ($makePayment['amount'] <= $getPayment['amount']) {
                    // setting percentMerged to false
                    $transaction['make_payment_user_id'] = $makePayment['user_id'];
                    $transaction['get_payment_user_id'] = $getPayment['user_id'];
                    $transaction['make_payment_id'] = $makePayment['id'];
                    $transaction['get_payment_id'] = $getPayment['id'];
                    $transaction['amount'] = $makePayment['amount'];
                    $makePayment->amount = 0;
                    $makePayment->status = 2; // get the status to merged
                } else {
                    $transaction['make_payment_user_id'] = $makePayment['user_id'];
                    $transaction['get_payment_user_id'] = $getPayment['user_id'];
                    $transaction['make_payment_id'] = $makePayment['id'];
                    $transaction['get_payment_id'] = $getPayment['id'];
                    $transaction['amount'] = $getPayment['amount'];
                    // Subtract the transaction amount from the make_payment
                    $makePayment->amount -= $transaction['amount'];
                }
                // save transaction
                Transaction::create($transaction);
                // update makePayment
                $makePayment->update();
                $getPayment['amount'] -= $transaction['amount'];

                if ($getPayment['amount'] <= 0) {
                    $getPayment['status'] = 2;
                }
                (GetPayment::find($getPayment['id']))->update((collect($getPayment))->except(['id','created_at','updated_at'])->toArray());
            }
            // Getpayment amount has not be cleared
            // put it back in the array
            if ($getPayment['amount'] > 0) {
                array_unshift($getPayments, $getPayment);
            }
        }
    }
}
