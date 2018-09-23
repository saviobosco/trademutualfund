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
use Illuminate\Foundation\Testing\DatabaseMigrations;
use \Illuminate\Auth\Middleware\EnsureEmailIsVerified;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TransactionsTest extends TestCase
{
    use DatabaseMigrations;

    public $transaction;

    public function setUp()
    {
        parent::setUp();
        $this->signIn();
        $make_payment = factory('App\MakePayment')->create(['user_id' => auth()->user()->id, 'status' => 2]);
        $get_payment = factory('App\GetPayment')->create(['status' => 2,'amount' => 0]);
        $this->transaction = factory('App\Transaction')->create([
            'make_payment_user_id' => auth()->user()->id,
            'make_payment_id' => $make_payment['id'],
            'get_payment_id' => $get_payment['id'],
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
            'status' => 2,
            'transaction_id' => $this->transaction['id']
        ]);
        $this->assertDatabaseHas('make_payments', [
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
        ]);

    }
}