<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('wallet_id');
            $table->foreign('wallet_id')->references('id')->on('wallets');
            $table->double('invested', 15, 4)->default(0);
            $table->double('percent', 15, 4)->default(0);
            $table->smallInteger('active')->default(0);
            $table->smallInteger('duration')->default(0);
            $table->smallInteger('accrue_times')->default(0);
            $table->timestamp('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('deposits');
    }
}



