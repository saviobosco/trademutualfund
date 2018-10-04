<?php
/**
 * Created by PhpStorm.
 * User: saviobosco
 * Date: 9/20/18
 * Time: 6:30 AM
 */

namespace tests\Feature;


use App\Http\Middleware\VerifyCsrfToken;
use App\Investment;
use App\Transaction;
use App\TransactionReport;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use \Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TransactionsTest extends TestCase
{
    use DatabaseMigrations;

    public $transaction, $make_payment;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
        $this->make_payment = factory('App\MakePayment')->create(['user_id' => auth()->user()->id, 'status' => 2]);
        $get_payment = factory('App\GetPayment')->create(['status' => 2,'amount' => 0]);
        $this->transaction = factory('App\Transaction')->create([
            'make_payment_user_id' => auth()->user()->id,
            'make_payment_id' => $this->make_payment['id'],
            'get_payment_id' => $get_payment['id'],
            'amount' => 50000
        ]);
        $this->withoutMiddleware([VerifyCsrfToken::class, EnsureEmailIsVerified::class]);
    }
    /** @test */
    public function user_can_view_active_transactions()
    {
        $response = $this->getJson('/transactions/active');
        $response->assertJsonCount(1, 'data');
    }

    /** @test */
    public function user_can_upload_transaction_proof() {
        Storage::fake('images');
        $file = UploadedFile::fake()->image('pop.jpg');
        $response = $this->postJson('/transactions/upload_proof/'.$this->transaction['id'], [
            'file' => $file
        ]);
        $response->assertSuccessful();
        $this->assertDatabaseHas('photo_proofs',[
            'photo_name' => $response->json('data')['photo_name']
        ]);
    }

    /** @test */
    public function user_can_remove_pop()
    {
        factory('App\PhotoProof')->create(['transaction_id' => $this->transaction['id']]);
        $response = $this->postJson('/transactions/remove_proof/'.$this->transaction['id'], [
            'image_id' => 1
        ]);
        $response->assertJsonFragment(['data' => 'Ok']);
    }

    /** @test */
    public function user_can_report_transaction()
    {
        $response = $this->postJson('/transactions/report/'.$this->transaction['id'], [
            'type' => 'fake_pop'
        ]);
        $response->assertJsonFragment(['transaction_id' => $this->transaction['id']]);
        $this->assertDatabaseHas('transaction_reports', [
           'type' => 'fake_pop'
        ]);
    }

    /** @test */
    public function user_can_confirm_transaction()
    {
        factory('App\TransactionReport')->create([
            'user_id' => auth()->user()->id,
            'transaction_id' => $this->transaction['id']
        ]);
        $response = $this->postJson('/transactions/confirm/'.$this->transaction['id']);
        $response->assertSuccessful();
        $response->assertJsonFragment(['data' =>'OK']);
        $this->assertDatabaseHas('transactions', [
           'status' => 2,
            'id' => $this->transaction['id']
        ]);
        $this->assertDatabaseHas('transaction_reports', [
            'status' => TransactionReport::STATUS_RESOLVED,
            'transaction_id' => $this->transaction['id']
        ]);
        $this->assertDatabaseHas('make_payments', [
            'amount_paid' => $this->transaction['amount'] ,
        ]);
        $this->assertDatabaseHas('get_payments', [
            'amount_paid' => $this->transaction['amount'] ,
        ]);
        $this->assertDatabaseHas('investments', [
            'status' => Investment::CONFIRMED,
            'amount_invested' => (string)$this->transaction['amount'],
        ]);
    }

    /** @test */
    public function user_can_cancel_transaction()
    {
        $response = $this->postJson('/transactions/cancel/'.$this->transaction['id']);
        $response->assertSuccessful();
        $response->assertJsonFragment(['data' =>'OK']);
        $this->assertDatabaseHas('transactions', [
            'status' => -1,
            'id' => $this->transaction['id']
        ]);
        $this->assertDatabaseHas('get_payments', [
            'status' => 1,
            'amount' => 50000
        ]);
    }

    public function user_can_cancel_all_transactions_with_same_make_payment_id()
    {
        /** for multiple transaction cancellation */
        factory('App\Transaction')->create([
            'make_payment_user_id' => auth()->user()->id,
            'make_payment_id' => $this->make_payment['id'],
        ]);
        factory('App\Transaction')->create([
            'make_payment_user_id' => auth()->user()->id,
            'make_payment_id' => $this->make_payment['id'],
        ]);
    }

    /** @test */
    public function user_can_reset_timer()
    {
        $this->signInAsAdmin();
        $response = $this->postJson('/transactions/reset_timer/'.$this->transaction['id']);
        $response->assertJsonFragment(['data' => 'OK']);
    }

    /** @test */
    public function user_can_resolve_issues()
    {
        $this->signInAsAdmin();
        $transaction = Transaction::find($this->transaction['id']);
        $transaction->reportFakeProofOfPayment(['user_id' => auth()->user()->id, 'type' => 'fake_pop']);
        $response = $this->postJson('/transactions/resolve_issue/'.$this->transaction['id']);
        $response->assertJsonFragment(['data' => 'OK']);
        $this->assertDatabaseHas('transaction_reports', [
            'status' =>TransactionReport::STATUS_RESOLVED
        ]);
    }

    /** @test */
    public function admin_can_view_transaction()
    {
        $this->signInAsAdmin();
        $response = $this->getJson('/transactions/view/'.$this->transaction['id']);
        $response->assertJsonCount(1);
    }

}