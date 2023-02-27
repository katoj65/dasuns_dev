<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_wallet', function (Blueprint $table) {
            $table->id();
            $table->integer('walletID');
            $table->integer('amount')->default(0);
            $table->enum('transaction',['deposit','payment','withdraw','refund'])->default('payment');
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
        Schema::dropIfExists('log_wallet');
    }
}
