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
                // update status to cashable
                $investment->cashOut();
            }
        }
    }
}
