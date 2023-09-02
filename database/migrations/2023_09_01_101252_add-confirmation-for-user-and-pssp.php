<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddConfirmationForUserAndPssp extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('appointment', function (Blueprint $table) {
            //
        $table->enum('user_confirm',['pending','done'])->after('status')->default('pending');

        $table->enum('provider_confirm',['pending','done'])->after('user_confirm')->default('pending');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('appointment', function (Blueprint $table) {
            //

            $table->enum('user_confirm',['pending','done'])->after('status')->default('pending');

            $table->enum('provider_confirm',['pending','done'])->after('user_confirm')->default('pending');



        });
    }
}
