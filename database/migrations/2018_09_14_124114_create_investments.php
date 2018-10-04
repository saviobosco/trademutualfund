<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvestments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id', false, true);
            $table->integer('make_payment_id', false, true)->nullable();
            $table->integer('get_payment_id', false, true)->nullable();
            $table->integer('investment_plan_id', false, true);
            $table->decimal('amount_invested', 13, 2)->nullable();
            $table->decimal('roi_amount', 13, 2)->nullable();
            $table->decimal('global_funds_amount', 13, 2)->nullable();
            $table->dateTime('release_date');
            $table->tinyInteger('status')->default(1)->comment('0 => created, 1 => commitment made, 2 => get payment created , 3 => completed');
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
        Schema::dropIfExists('investments');
    }
}
