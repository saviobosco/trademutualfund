<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('make_payment_user_id');
            $table->integer('get_payment_user_id');
            $table->integer('get_payment_id')->nullable();
            $table->integer('make_payment_id')->nullable();
            $table->decimal('amount', 13, 4);
            $table->dateTime('time_elapse_after');
            $table->dateTime('confirmed_at')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
