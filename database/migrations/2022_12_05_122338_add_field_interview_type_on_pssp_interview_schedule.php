<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldInterviewTypeOnPsspInterviewSchedule extends Migration
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
            $table->enum('type',['online','physical'])->afrer('time');
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
            $table->enum('type',['online','physical'])->after('time');
            //
        });
    }
}
