<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPsspInterviewId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pssp_interview_schedule', function (Blueprint $table) {
            //
            $table->integer('applicationID')->afrer('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pssp_interview_schedule', function (Blueprint $table) {
            //
            $table->integer('applicationID')->afrer('id');
        });
    }
}
