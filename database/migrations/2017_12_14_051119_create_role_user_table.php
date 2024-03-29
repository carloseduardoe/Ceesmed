<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
  public function up()
  {
    Schema::create('role_user', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('user_id')->unsigned();
      $table->integer('role_id')->unsigned();
      $table->unique(['user_id', 'role_id']);

      $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
      $table->foreign('role_id')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
    });
  }

  public function down()
  {
    Schema::table('role_user', function(Blueprint $table){
      $table->dropForeign('role_user_user_id_foreign');
      $table->dropForeign('role_user_role_id_foreign');
    });

    Schema::dropIfExists('role_user');
  }
}
