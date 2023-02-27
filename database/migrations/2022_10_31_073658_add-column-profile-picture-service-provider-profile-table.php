<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnProfilePictureServiceProviderProfileTable extends Migration
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
            $table->string('profile_picture')->nullable()->after('countryID');
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
            $table->string('profile_picture')->nullable()->after('countryID');
        });
    }
}
