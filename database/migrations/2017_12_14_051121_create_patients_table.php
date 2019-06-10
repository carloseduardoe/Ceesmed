<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
  public function up()
  {
    Schema::create('patients', function (Blueprint $table) {
      $table->integer('user_id')->unsigned()->primary();
      $table->date('birthdate')->nullable();
      $table->enum('gender', ['m', 'f', '*'])->default('*');
      $table->enum('bloodtype', [
        'A +', 'A -', 'A *', 'B +', 'B -', 'B *',
        'AB+', 'AB-', 'AB*', 'O +', 'O -', 'O *',
        '*',
      ])->default('*');
      $table->mediumText('notes')->nullable();
      $table->boolean('viewhistory')->default(false);

      $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
    });
  }

  public function down()
  {
    Schema::table('patients', function(Blueprint $table){
      $table->dropForeign('patients_user_id_foreign');
    });

    Schema::dropIfExists('patients');
  }
}
