<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentClockingTable extends Migration
{
/**
 * Run the migrations.
 *
 * @return void
 */
public function up()
{
Schema::create('appointment_clocking', function (Blueprint $table) {
$table->id();
$table->integer('appointmentID');
$table->date('date');
$table->enum('status',['pending','completed','canceled']);
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
Schema::dropIfExists('appointment_clocking');
}
}
