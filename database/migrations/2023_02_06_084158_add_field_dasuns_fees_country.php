<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldDasunsFeesCountry extends Migration
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
            $table->integer('countryID');
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
            $table->integer('countryID');
        });
    }
}
