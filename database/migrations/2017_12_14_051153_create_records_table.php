<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
  public function up()
  {
    Schema::create('records', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('patient_id')->unsigned();
      $table->string('description', 4000);
      $table->string('diagnosis', 1000);
      $table->string('prescription', 4500);
      $table->timestamps();

      $table->foreign('patient_id')->references('user_id')->on('patients')->onUpdate('CASCADE')->onDelete('CASCADE');
    });
  }

  public function down()
  {
    Schema::table('records', function(Blueprint $table){
      $table->dropForeign('records_patient_id_foreign');
    });

    Schema::dropIfExists('records');
  }
}
