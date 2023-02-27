<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangeFieldNamesForUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('firstname');
            $table->string('lastname');
            $table->enum('gender',['male','female','other']);
            // $table->date('dob');
            $table->string('location');
            $table->integer('tel');
            // $table->string('email')->unique();
            $table->enum('role',['ssp','ssu','admin','finance','customer_service']);
            // $table->string('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->string('firstname');
            $table->string('lastname');
            $table->enum('gender',['male','female','other']);
            // $table->date('dob');
            $table->string('location');
            $table->integer('tel');
            // $table->string('email')->unique();
            $table->enum('role',['ssp','ssu','admin','finance','customer_service']);
            // $table->string('password');
        });
    }
}
