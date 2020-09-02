<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name', 30);
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('wallet_id');
            $table->foreign('wallet_id')->references('id')->on('wallets');
            $table->integer('deposit_id')->nullable();
            $table->foreign('deposit_id')->references('id')->on('deposits');
            $table->double('amount', 15, 4)->default(0);
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
        Schema::dropIfExists('transactions');
    }
}

