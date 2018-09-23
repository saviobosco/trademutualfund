<?php

namespace App\Console\Commands;

use App\GlobalFund;
use App\Investment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ProcessInvestments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'investments:process';

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
        // get all confirmed investments
        $investments = Investment::query()->where([
            'status' => Investment::CONFIRMED,
        ])->get();
        foreach($investments as $investment) {
            // if the investment->release_date < time // release it
            if ($investment->release_date < new Carbon()) {
                // create a new get payment
                $investment->get_payment()->create([
                    'amount' => $investment->roi_amount,
                    'initial_amount' => $investment->roi_amount,
                    'user_id' => $investment->user_id,
                ]);
                $investment->merged();
                // create global funds
                GlobalFund::create([
                   'investment_id' => $investment['id'],
                    'amount' => $investment['global_funds_amount'],
                ]);
            }
        }
    }

}
