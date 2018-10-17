<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 10/17/18
 * Time: 9:27 AM
 */

namespace Tests\Unit\Console\Commands;


use App\Console\Commands\ProcessTransactions;
use App\Transaction;
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
}