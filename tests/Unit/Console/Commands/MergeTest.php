<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 10/17/18
 * Time: 8:19 AM
 */

namespace Tests\Unit\Console\Commands;


use App\Console\Commands\Merge;
use App\GetPayment;
use App\MakePayment;
use App\Transaction;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class MergeTest extends TestCase
{

    public $Merge;
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->Merge = new Merge();
    }

    /** @test */
    public function testHandleMerging()
    {
        // make get payments
        // make make payments
        $user = factory('App\User')->create();
        factory('App\GetPayment')->create([
            'user_id' => $user->id,
            'amount' => 500000,
            'initial_amount' => 500000
        ]);
        factory('App\GetPayment',2)->create();
        factory('App\MakePayment',4)->create([
            'amount' => 50000,
            'initial_amount' => 50000
        ]);
        factory('App\MakePayment')->create([
            'user_id' => $user->id,
            'amount' => 150000,
            'initial_amount' => 150000
        ]);
        $this->Merge->handle();
        // assert the transactions has 4 rows
        // assert that the get payment is amount is 300000
        $transactions = Transaction::count();
        $this->assertEquals(4, $transactions);

        // check if all make payment status is Merged
        $this->assertEquals(4, MakePayment::query()->where('status', MakePayment::MERED_OUT)->count());

        $getPayment = GetPayment::query()->where('user_id', $user->id)->first();
        $this->assertEquals('300000', $getPayment['amount']);
    }

    /** @test */
    public function testHandleMergingWithLessGetPayment()
    {
        $user = factory('App\User')->create();

        factory('App\GetPayment',2)->create();

        factory('App\MakePayment')->create([
            'user_id' => $user->id,
            'amount' => 300000,
            'initial_amount' => 300000
        ]);

        $this->Merge->handle();
        // assert the transactions has 4 rows
        // assert that the get payment is amount is 300000
        $transactions = Transaction::count();
        $this->assertEquals(2, $transactions);
        $makePayment = MakePayment::query()->where('user_id', $user->id)->first();
        $this->assertEquals('200000', $makePayment['amount']);

        // check if all get payment status is Merged
        $this->assertEquals(2, GetPayment::query()->where('status', GetPayment::STATUS_MERGED)->count());
    }

    /** @test */
    /*public function testHandleMergingWithBlockedUsers()
    {
        // make get payments
        // make make payments
        $user = factory('App\User')->create(['blocked_at' => now()]);
        $user2 = factory('App\User')->create(['blocked_at' => now()]);
        factory('App\GetPayment')->create([
            'user_id' => $user->id,
            'amount' => 500000,
            'initial_amount' => 500000
        ]);
        factory('App\GetPayment',2)->create();

        factory('App\MakePayment')->create([
            'amount' => 50000,
            'initial_amount' => 50000,
            'user_id' => $user2->id
        ]);
        factory('App\MakePayment',4)->create([
            'amount' => 50000,
            'initial_amount' => 50000
        ]);
        factory('App\MakePayment')->create([
            'user_id' => $user->id,
            'amount' => 150000,
            'initial_amount' => 150000
        ]);
        $this->Merge->handle();
        // assert the transactions has 4 rows
        // assert that the get payment is amount is 300000
        $transactions = Transaction::count();
        $this->assertEquals(2, $transactions);

        // check that 2 make payment status is Merged
        $this->assertEquals(2, MakePayment::query()->where('status', MakePayment::MERED_OUT)->count());

        $getPayment = GetPayment::query()->where('user_id', $user->id)->first();
        $this->assertEquals('500000', $getPayment['amount']);
    }*/
}