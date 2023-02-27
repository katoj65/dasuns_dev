<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnVetPsspProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('service_provider_profile', function (Blueprint $table) {
            //
            $table->enum('vet_status',['pending','suceess','fail'])->default('pending')->after('countryID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('service_provider_profile', function (Blueprint $table) {
            //
            $table->enum('vet_status',['pending','suceess','fail'])->default('pending')->after('countryID');
        });
    }
}
