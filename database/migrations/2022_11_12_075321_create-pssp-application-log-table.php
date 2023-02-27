<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePsspApplicationLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pssp_applications', function (Blueprint $table) {
            $table->id();
            $table->integer('userID');
            $table->string('applicationID')->nullable();
            $table->enum('status',['pending','approved','declined','banned'])->default('pending');
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
        Schema::dropIfExists('pssp_applications');
    }
}
