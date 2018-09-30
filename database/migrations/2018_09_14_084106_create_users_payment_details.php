<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersPaymentDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_payment_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->string('account_name')->nullable();
            $table->string('account_number')->nullable();
            $table->integer('bank_id')->nullable();
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
        /*Schema::create('user_payment_details', function (Blueprint $table) {
            $table->dropForeign('user_id');
        });*/
        Schema::dropIfExists('user_payment_details');
    }
}
