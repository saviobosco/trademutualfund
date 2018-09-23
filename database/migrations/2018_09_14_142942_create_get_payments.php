<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('get_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('investment_id')->nullable();
            $table->decimal('amount', 13, 4);
            $table->decimal('initial_amount', 13, 4);
            $table->decimal('amount_paid')->nullable()->comment('This column hold the total amount the users has received , if it is equal to the amount column, the record will be marked as completed');
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
        Schema::dropIfExists('get_payments');
    }
}
