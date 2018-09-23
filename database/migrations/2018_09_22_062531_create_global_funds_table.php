<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGlobalFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('global_funds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('investment_id');
            $table->decimal('amount', 13, 4);
            $table->integer('user_id')->nullable()->comment('The admin user who collected the money');
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('global_funds');
    }
}
