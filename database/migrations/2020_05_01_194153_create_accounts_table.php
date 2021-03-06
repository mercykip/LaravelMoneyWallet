<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { if(!Schema::hasTable('accounts')){
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('accountId');
            $table->integer('amount')->nullable();
            $table->float('charges', 8, 2)->nullable();
            $table->float('tax', 8, 2)->nullable();
            $table->string('email')->unique();
            $table->unsignedBigInteger('customerId')->nullable();
            $table->foreign('customerId')->references('customerId')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('accounts');
        
    }
}
