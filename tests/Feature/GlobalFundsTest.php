<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class GlobalFundsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->signInAsAdmin();
    }

    /** @test */
    public function admin_can_cash_out_global_bonus()
    {
        setting(['global_funds' => '30000']);
        $postData = [
            'amount' => '21000',
            'user_id' => 1
        ];
        $response = $this->post('/global_funds/cash_out', $postData);
        $response->assertRedirect();
        $response->assertSessionHas('flash_notification.0.message', 'Global fund cash was successful');
        $this->assertDatabaseHas('get_payments', [
            'amount' => $postData['amount']
        ]);
        $this->assertDatabaseHas('global_fund_activities', [
            'user_id' => $postData['user_id'],
            'amount' => $postData['amount']
        ]);
    }

    /** @test */
    public function admin_can_cash_out_global_bonus_failed()
    {
        setting(['global_funds' => '30000']);
        $postData = [
            'amount' => '41000',
            'user_id' => 1
        ];
        $response = $this->post('/global_funds/cash_out', $postData);
        $response->assertRedirect();
        $response->assertSessionHas('flash_notification.0.message', 'Amount cannot be greater than global funds');
    }
}
