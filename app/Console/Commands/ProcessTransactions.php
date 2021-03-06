<?php

namespace App\Console\Commands;

use App\Investment;
use App\MakePayment;
use App\Transaction;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProcessTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transactions:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        // get all transaction with photos and issues
        // if transaction has no photo and time is up , cancel
        $transactions = $this->getActiveTransactions();
        if (count($transactions) <= 0) {
            return ;
        }
        $now = Carbon::now();
        foreach($transactions as $transaction) {
            if ($transaction->time_elapse_after < $now ) {
                // if transaction has active support, leave it
                if (count($transaction->transaction_reports) >= 1 ) {
                    continue;
                }
                if (count($transaction->photo_proofs) >= 1) {
                    $transaction->confirm();
                } else {
                    //$transaction->cancel();
                    // cancel the first transaction and get other ones where status = 1 and cancel also
                    // find all make payment and cancel them
                    $transactionsWithSameMakePayment = Transaction::query()->where('make_payment_id', $transaction['make_payment_id'])->get();
                    foreach($transactionsWithSameMakePayment as $transactionWithSameMakePayment) {
                        $transactionWithSameMakePayment->cancel();
                    }
                    $makePayment = MakePayment::find($transaction['make_payment_id']);
                    if ($investment = Investment::find($makePayment['investment_id'])) {
                        $investment->cancel();
                        $user = User::find($investment['user_id']);
                        $user->markUserAsBlocked();
                    }
                }
            }
        }
    }

    protected function getActiveTransactions()
    {
        return Transaction::query()
            ->with(['photo_proofs',
                'transaction_reports' => function($query) {
                    $query->where('status', 1);
                }
            ])
            ->where('transactions.status', 1)
            ->get();
    }
}
