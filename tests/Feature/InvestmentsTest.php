<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 9/20/18
 * Time: 6:30 AM
 */

namespace tests\Feature;


use App\InvestmentPlan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Http\Middleware\VerifyCsrfToken;
use \Illuminate\Auth\Middleware\EnsureEmailIsVerified;

class InvestmentsTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->withoutMiddleware([VerifyCsrfToken::class, EnsureEmailIsVerified::class]);
    }

    /** @test */
    public function user_can_start_new_investment()
    {
        $this->signIn();
        $this->makeInvestmentPlans();
        $this->assertDatabaseHas('user_settings', [
            'last_investment_plan' => null
        ]);
        $response = $this->post('/investments/create', [
            'plan' => 1,
            'rule' => 1,
            'amount' => 300000
        ]);
        $response->assertRedirect();
        $response->assertSessionHas('message', 'You have successfully started a new investment!');
        $this->assertDatabaseHas('user_settings', [
           'last_investment_plan' => 1
        ]);
    }

    /** @test */
    public function user_can_cancel_investment()
    {
        $makePayment = factory('App\MakePayment')->create();
        $investment = factory('App\Investment')->create(['make_payment_id' => $makePayment['id']]);
        $makePayment->update(['investment_id' => $investment['id']]);
        $response = $this->put('/investments/cancel/'.$investment['id']);
        $response->assertJsonFragment(['data' => 'OK']);
        $this->assertDatabaseHas('investments', [
           'status' => -1,
            'id' => $investment['id']
        ]);
        $this->assertDatabaseHas('make_payments', [
            'investment_id' => $investment['id']
        ]);
    }

    /** @test */
    public function user_investment_plans()
    {
        $this->signIn();
        auth()->user()->user_setting()->update(['last_investment_plan' => 2]);
        $this->makeInvestmentPlans();
        $response = $this->get('/user_investment_plans');
        $response->assertSuccessful();
    }
}