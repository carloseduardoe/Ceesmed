<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
  public function up()
  {
    Schema::create('schedules', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('doctor_id')->unsigned();
      $table->enum('day', ['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun']);
      $table->time('start');
      $table->time('end');
      $table->unique(['doctor_id', 'day', 'start', 'end']);

      $table->foreign('doctor_id')->references('id')->on('doctors')->onUpdate('CASCADE')->onDelete('CASCADE');
    });
  }

  public function down()
  {
    Schema::table('schedules', function(Blueprint $table){
      $table->dropForeign('schedules_doctor_id_foreign');
    });

    Schema::dropIfExists('schedules');
  }
}
