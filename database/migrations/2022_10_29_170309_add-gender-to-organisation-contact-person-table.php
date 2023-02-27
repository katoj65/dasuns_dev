<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenderToOrganisationContactPersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('organisation_contact_person', function (Blueprint $table) {
            //
            $table->enum('gender',['male','female','other'])->default('other')->after('lastname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('organisation_contact_person', function (Blueprint $table) {
            //
            $table->enum('gender',['male','female','other'])->default('other');
        });
    }
}
