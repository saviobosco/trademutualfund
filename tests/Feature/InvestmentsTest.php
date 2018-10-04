<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 9/20/18
 * Time: 6:30 AM
 */

namespace tests\Feature;


use App\Investment;
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
        $response = $this->post('/user_investments/create', [
            'plan' => 1,
            'rule' => 1,
            'amount' => 300000
        ]);
        $response->assertRedirect();
        //dd($response);
        $response->assertSessionHas('flash_notification.0.message', 'You have successfully started a new investment!');
        $this->assertDatabaseHas('user_settings', [
           'last_investment_plan' => 1
        ]);
    }

    /** @test */
    public function user_can_cancel_investment()
    {
        $this->signIn();
        $makePayment = factory('App\MakePayment')->create();
        $investment = factory('App\Investment')->create([
            'make_payment_id' => $makePayment['id'],
            'user_id' => auth()->user()->id
        ]);
        $makePayment->update(['investment_id' => $investment['id']]);
        $response = $this->post('/user_investments/cancel/'.$investment['id']);
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
        $this->makeInvestmentPlans();
        $response = $this->get('/user_investment_plans');
        $response->assertSuccessful();
        $response->assertJsonCount(4, 'data');
    }

    /** @test */
    public function user_investment_plans_after_selecting_a_higher_plan()
    {
        $this->signIn();
        auth()->user()->user_setting()->update(['last_investment_plan' => 2]);
        $this->makeInvestmentPlans();
        $response = $this->get('/user_investment_plans');
        $response->assertSuccessful();
        $response->assertJsonCount(3, 'data');
    }

    /** @test */
    public function user_view_all_investments()
    {
        $this->signIn();
        factory('App\Investment', 4)->create([
            'user_id' => auth()->user()->id,
        ]);
        $response = $this->get('/user_investments/index');
        $response->assertViewIs('user_investments.index');
        $response->assertViewHas('investments');
    }

    /** @test */
    public function user_can_cash_out_a_cashAble_investment()
    {
        $this->signIn();
        $investment = factory('App\Investment')->create([
            'user_id' => auth()->user()->id,
            'status' => Investment::CASH_OUT,
        ]);
        $response = $this->post('/user_investments/cash_out/'.$investment->id);
        $response->assertJson(["data" => "OK"]);
    }

    public function user_cannot_cash_out_an_unCashAble_investment()
    {
        $this->signIn();
        $investment = factory('App\Investment')->create([
            'user_id' => auth()->user()->id,
        ]);
        $response = $this->post('/user_investments/cash_out/'.$investment->id);
        $response->assertStatus(422);
        $response->assertJson(["data" => "Error"]);
    }

    /** @test */
    public function user_can_add_a_testimony_after_successful_investment_completion()
    {
        $this->signIn();
        $investment = factory('App\Investment')->create([
            'user_id' => auth()->user()->id,
            'status' => Investment::COMPLETED
        ]);
        $response = $this->post('/user_investments/addTestimony/'.$investment->id, [
            'testimony' => 'Hello world I want to tell you all about this lovely place'
        ]);
        $response->assertJson(["data" => "OK"]);
        $this->assertDatabaseHas('testimonies', [
            'testimony' => 'Hello world I want to tell you all about this lovely place',
            'investment_id' => $investment->id,
            'user_id' => auth()->user()->id
        ]);
    }
}