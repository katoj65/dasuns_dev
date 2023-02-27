<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDasunsUserNumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dasuns_user_number', function (Blueprint $table) {
            $table->id();
            $table->integer('userID');
            $table->string('number');
            $table->enum('role',['pssu','pssp']);
            $table->enum('account_status',['pending','verified','blocked','suspended']);
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
        Schema::dropIfExists('dasuns_user_number');
    }
}
