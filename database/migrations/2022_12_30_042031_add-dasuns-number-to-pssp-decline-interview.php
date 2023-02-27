<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDasunsNumberToPsspDeclineInterview extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pssp_declined_interview', function (Blueprint $table) {
            //
            $table->integer('applicantID')->after('interviewID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pssp_declined_interview', function (Blueprint $table) {
            //
            $table->integer('applicantID')->after('interviewID');
        });
    }
}
