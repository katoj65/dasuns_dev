<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('system', function (Blueprint $table) {
            //
            $table->string('facebook')->after('website');
            $table->string('twitter')->after('facebook');
            $table->string('linkedin')->after('twitter');
            $table->string('youtube')->after('linkedin');
            $table->string('whatsapp')->after('youtube');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('system', function (Blueprint $table) {
            //
            $table->string('facebook');
            $table->string('twitter');
            $table->string('linkedin');
            $table->string('youtube');
            $table->string('whatsapp');
        });
    }
}
