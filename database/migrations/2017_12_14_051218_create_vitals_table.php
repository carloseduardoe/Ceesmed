<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVitalsTable extends Migration
{
  public function up() {
    Schema::create('vitals', function (Blueprint $table) {
      $table->integer('record_id')->unsigned()->primary();
      $table->integer('pulse')->unsigned()->nullable();
      $table->decimal('bpsystolic', 5, 2)->unsigned()->nullable();
      $table->decimal('bpdiastolic', 5, 2)->unsigned()->nullable();
      $table->decimal('temperature', 4, 2)->unsigned()->nullable();
      $table->decimal('weight', 5, 2)->unsigned();
      $table->decimal('height', 5, 2)->unsigned();

      $table->foreign('record_id')->references('id')->on('records')->onUpdate('CASCADE')->onDelete('CASCADE');
    });
  }

  public function down() {
    Schema::table('vitals', function(Blueprint $table){
      $table->dropForeign('vitals_record_id_foreign');
    });

    Schema::dropIfExists('vitals');
  }
}
