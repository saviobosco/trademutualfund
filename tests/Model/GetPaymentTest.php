<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 11/11/18
 * Time: 3:24 PM
 */

namespace Tests\Model;

use App\GetPayment;
use App\Investment;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class GetPaymentTest extends TestCase
{
    use DatabaseMigrations;
    public function testUpdatedAmountPaid()
    {
        $investment = factory('App\Investment')->create([
            'status' => Investment::CASHED_OUT
        ]);
        $getPayment = factory('App\GetPayment')->create([
            'investment_id' => $investment['id'],
            'amount' => '100000',
            'status' => GetPayment::STATUS_MERGED,
            'initial_amount' => '100000',
        ]);
        $getPayment->updateAmountPaid(['amount_paid' => '50000']);
        $this->assertEquals(true, $getPayment->updateAmountPaid(['amount_paid' => '50000']));
        $this->assertDatabaseHas('get_payments', [
            'status' => 3
        ]);
        $this->assertDatabaseHas('investments', [
            'status' => 5
        ]);
    }
}