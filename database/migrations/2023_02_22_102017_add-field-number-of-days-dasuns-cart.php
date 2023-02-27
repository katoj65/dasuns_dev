<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldNumberOfDaysDasunsCart extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dasuns_cart', function (Blueprint $table) {
            //
            $table->integer('days')->after('currency');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dasuns_cart', function (Blueprint $table) {
            //
            $table->integer('days')->after('currency');
        });
    }
}
