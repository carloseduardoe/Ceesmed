<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
  public function up()
  {
    Schema::create('appointments', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('doctor_id')->unsigned();
      $table->integer('patient_id')->unsigned();
      $table->datetime('time');
      $table->enum('type', ['check', 'consultation', 'therapy']);
      $table->string('reason');
      $table->unique(['doctor_id', 'patient_id', 'time']);

      $table->foreign('doctor_id')->references('id')->on('doctors')->onUpdate('CASCADE')->onDelete('CASCADE');
      $table->foreign('patient_id')->references('user_id')->on('patients')->onUpdate('CASCADE')->onDelete('CASCADE');
    });
  }

  public function down()
  {
    Schema::table('appointments', function(Blueprint $table){
      $table->dropForeign('appointments_doctor_id_foreign');
      $table->dropForeign('appointments_patient_id_foreign');
    });

    Schema::dropIfExists('appointments');
  }
}
