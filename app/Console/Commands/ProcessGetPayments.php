<?php

namespace App\Console\Commands;

use App\GetPayment;
use Illuminate\Console\Command;

class ProcessGetPayments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getPayments:process';

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
        //get all get payments with status 2
        $getPayments = GetPayment::query()->where([
            'status' => GetPayment::STATUS_MERGED
        ])->get();
        $countGetPayments = count($getPayments);
        if ($countGetPayments <= 0) { return ; }
        for($num = 0; $num < $countGetPayments; $num++) {
            $getPayments[$num]->markRecordAsConfirmed();
        }
        // check if the initial amount and paid amount are same
        // comfirm transaction and complete investment
    }
}
