<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMakePayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('make_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('investment_id')->nullable();
            $table->decimal('amount', 13, 2);
            $table->decimal('initial_amount', 13, 2);
            $table->decimal('amount_paid', 13, 2)->nullable()->comment('This column hold the total amount the users has paid out, if it is equal to the amount column, the record will be marked as completed');
            $table->dateTime('completed_at')->nullable();
            $table->integer('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('make_payments');
    }
}
