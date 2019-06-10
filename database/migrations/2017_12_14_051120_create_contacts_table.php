<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
  public function up()
  {
    Schema::create('contacts', function (Blueprint $table) {
      $table->integer('user_id')->unsigned()->primary();
      $table->char('phone', 12)->nullable();
      $table->char('mobile', 12)->nullable();
      $table->char('address', 100)->nullable();
      $table->char('city', 30)->nullable();

      $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
    });
  }

  public function down()
  {
    Schema::table('contacts', function(Blueprint $table){
      $table->dropForeign('contacts_user_id_foreign');
    });

    Schema::dropIfExists('contacts');
  }
}
