<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePssInterviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pssp_interview_schedule', function (Blueprint $table) {
            $table->id();
            $table->integer('service_providerID');
            $table->date('date');
            $table->time('time');
            $table->mediumText('comment')->nullable();
            $table->enum('status',['scheduled','accepted','passed','failed','canceled','declined']);
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
        Schema::dropIfExists('pssp_interview_schedule');
    }
}
