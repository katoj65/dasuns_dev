<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldRecommendationnIDOnInterviewRecommendation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pssp_interview_recommendation', function (Blueprint $table) {
            //
            $table->integer('recommendationID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pssp_interview_recommendation', function (Blueprint $table) {
            $table->integer('recommendationID');
            //
        });
    }
}
