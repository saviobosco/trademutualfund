<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 10/17/18
 * Time: 9:27 AM
 */

namespace Tests\Unit\Console\Commands;


use App\Console\Commands\ProcessTransactions;
use App\GetPayment;
use App\Investment;
use App\MakePayment;
use App\Transaction;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Carbon\Carbon;


class ProcessTransactionsTest extends TestCase
{

    use DatabaseMigrations;

    public $ProcessTransactions;

    public function setUp()
    {
        parent::setUp();
        $this->ProcessTransactions = new ProcessTransactions();
    }

    /** @test */
    public function testHandleProcessTransactions()
    {
        factory('App\Transaction', 4)->create([
            'time_elapse_after' => (new Carbon())->subHour()
        ]);
        $this->ProcessTransactions->handle();
        $this->assertEquals(4, Transaction::query()->where('status', Transaction::CANCELLED)->count());
    }

    /** @test */
    public function testHandleProcessTransactionsWithReports()
    {
        factory('App\Transaction',  4)->create([
            'time_elapse_after' => (new Carbon())->subHour()
        ])->each(function($transaction) {
            $transaction->transaction_reports()->create(['user_id' => $transaction->get_payment_user_id]);
        });
        $this->ProcessTransactions->handle();
        $this->assertEquals(0, Transaction::query()->where('status', Transaction::CANCELLED)->count());
    }

    /** @test */
    public function testHandleProcessTransactionsWithPhotos()
    {
        factory('App\Transaction',  4)->create([
            'time_elapse_after' => (new Carbon())->subHour()
        ])->each(function($transaction) {
            $transaction->photo_proofs()->create(['photo_name' => 'jpg.png']);
        });
        $this->ProcessTransactions->handle();
        $this->assertEquals(4, Transaction::query()->where('status', Transaction::CONFIRMED)->count());
    }

    /** @test */
    public function testCancelTransactionWithMakePaymentAndGetPayment()
    {
        $getPayment1 = factory('App\GetPayment')->create([
            'amount'=> 0,
            'initial_amount' => 100000,
            'status' => GetPayment::STATUS_MERGED
        ]);
        $getPayment2 = factory('App\GetPayment')->create([
            'amount'=> 0,
            'initial_amount' => 100000,
            'status' => GetPayment::STATUS_MERGED
        ]);

        $investment = factory('App\Investment')->create(['amount_invested' => 200000]);
        $makePayment =  factory('App\MakePayment')->create(['investment_id' => $investment['id'], 'amount' => 0, 'initial_amount' => 200000, 'status' => MakePayment::MERGED_OUT]);


        // create 4 transactions
        $tran1 = factory('App\Transaction')->create(['make_payment_id' => $makePayment['id'], 'get_payment_id' => $getPayment1['id'], 'time_elapse_after' => (new Carbon())->subHour()]);
        factory('App\Transaction')->create(['make_payment_id' => $makePayment['id'], 'get_payment_id' => $getPayment1['id'], 'time_elapse_after' => (new Carbon())->subHour()]);
        factory('App\Transaction')->create(['make_payment_id' => $makePayment['id'], 'get_payment_id' => $getPayment2['id'], 'time_elapse_after' => (new Carbon())->subHour()]);
        factory('App\Transaction')->create(['make_payment_id' => $makePayment['id'], 'get_payment_id' => $getPayment2['id'], 'time_elapse_after' => (new Carbon())->subHour()]);

        $this->ProcessTransactions->handle();

        $this->assertEquals(4, Transaction::query()->where('status', Transaction::CANCELLED)->count());
        $this->assertEquals(2, GetPayment::query()->where('status', GetPayment::STATUS_ACTIVE)->count());
        $this->assertDatabaseHas('get_payments', [
           'amount' => 100000
        ]);
        $this->assertEquals(MakePayment::CANCELLED, MakePayment::find($makePayment['id'])['status']);
        $this->assertEquals(Investment::CANCELLED, Investment::find($investment['id'])['status']);

        $user = User::find($investment['user_id']);
        $this->assertEquals(true, $user->isUserBlocked());
    }
}