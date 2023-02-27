<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePanelistProfessionProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panelist_profession_profile', function (Blueprint $table) {
            $table->id();
            $table->integer('userID');
            $table->integer('professionID');
            $table->mediumText('description')->nullable();
            $table->integer('number_years');
            $table->enum('status',['pending','active','deactivate']);
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
        Schema::dropIfExists('panelist_profession_profile');
    }
}
