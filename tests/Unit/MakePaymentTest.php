<?php

namespace Tests\Unit;

use App\MakePayment;
use App\ReferralPyramid;
use App\ReferralsBonus;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MakePaymentTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function testHello()
    {
        $this->assertEquals(1, 1);
    }

    /** @test */
    /*public function testUpdateAmountPaidWith2Ancestors()
    {
        // create grandparent
        $grandAncestor  = factory('App\User')->create();
        $grandParent = ReferralPyramid::create([
            'user_id' => $grandAncestor['id'],
            'name' => $grandAncestor['name']
        ]);
        $ancestor = factory('App\User')->create();
        $parent = ReferralPyramid::create([
            'user_id' => $ancestor['id'],
            'name' => $ancestor['name']
        ]);
        $grandParent->appendNode($parent);

        $child = factory('App\User')->create();
        $childRef = ReferralPyramid::create([
            'user_id' => $child['id'],
            'name' => $child['name']
        ]);
        $parent->appendNode($childRef);

        $makePayment = MakePayment::create([
            'user_id' => $child['id'],
            'amount_paid' => 0,
            'amount' => 0,
            'initial_amount' => 50000,
            'status' => MakePayment::MERED_OUT
        ]);
        $makePayment->updateAmountPaid(['amount_paid' => 50000]);

        $this->assertEquals(2, ReferralsBonus::count());
    }

    public function testUpdateAmountPaidWithOneAncestor()
    {
        $ancestor = factory('App\User')->create();
        $parent = ReferralPyramid::create([
            'user_id' => $ancestor['id'],
            'name' => $ancestor['name']
        ]);

        $child = factory('App\User')->create();
        $childRef = ReferralPyramid::create([
            'user_id' => $child['id'],
            'name' => $child['name']
        ]);
        $parent->appendNode($childRef);

        $makePayment = MakePayment::create([
            'user_id' => $child['id'],
            'amount_paid' => 0,
            'amount' => 0,
            'initial_amount' => 50000,
            'status' => MakePayment::MERED_OUT
        ]);
        $makePayment->updateAmountPaid(['amount_paid' => 50000]);

        $this->assertEquals(1, ReferralsBonus::count());
    }*/

}
