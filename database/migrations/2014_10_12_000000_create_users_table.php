<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
  public function up()
  {
    Schema::create('users', function (Blueprint $table) {
      $table->increments('id');
      $table->char('nid', 13)->nullable();
      $table->string('name');
      $table->string('email')->default("no email");
      $table->string('password');
      $table->string('avatar')->default('public/avatars/default.png');
      $table->rememberToken();
      $table->timestamps();
      $table->boolean('active')->default(false);
    });

    DB::statement('ALTER TABLE users ADD FULLTEXT user_search_index (name, nid, email)');
  }

  public function down()
  {
    Schema::dropIfExists('users');
  }
}
