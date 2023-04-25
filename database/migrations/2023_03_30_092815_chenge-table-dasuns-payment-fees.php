<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChengeTableDasunsPaymentFees extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dasuns_payment_fees', function (Blueprint $table) {
            //
            $table->integer('charges')->after('amount');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dasuns_payment_fees', function (Blueprint $table) {
            //
            $table->integer('charges')->default(0)->after('amount');
        });
    }
}
