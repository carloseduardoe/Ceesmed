<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
  public function up()
  {
    Schema::create('media', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('record_id')->unsigned()->nullable();
      $table->char('mime', 255);
      $table->string('path');

      $table->foreign('record_id')->references('id')->on('records')->onUpdate('CASCADE')->onDelete('CASCADE');
    });
  }

  public function down()
  {
    Schema::table('media', function(Blueprint $table){
      $table->dropForeign('media_record_id_foreign');
    });

    Schema::dropIfExists('media');
  }
}
