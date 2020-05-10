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
    {if(!Schema::hasTable('transactions')){
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('transactionId');
            $table->integer('amount')->nullable();
            $table->string('email')->nullable();
            $table->unsignedBigInteger('accountId')->nullable();
            $table->foreign('accountId')->references('accountId')->on('accounts')->onDelete('set null');
            $table->timestamps();
        });
    }
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
