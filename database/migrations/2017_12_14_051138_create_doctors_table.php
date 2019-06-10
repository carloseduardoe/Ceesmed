<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
  public function up()
  {
    Schema::create('doctors', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('user_id')->unsigned();
      $table->enum('specialty', [
        'Anatomical pathology', 'Anesthesiology', 'Cardiology', 'Cardiovascular/thoracic surgery',
        'Clinical immunology/allergy', 'Dermatology', 'Diagnostic radiology', 'Emergency medicine',
        'Endocrinology/metabolism', 'Family medicine', 'Gastroenterology', 'General Internal Medicine',
        'General/clinical pathology', 'General surgery', 'Geriatric medicine', 'Hematology',
        'Medical biochemistry', 'Medical genetics', 'Medical oncology', 'Medical microbiology and infectious diseases',
        'Nephrology', 'Neurology', 'Neurosurgery', 'Nuclear medicine', 'Obstetrics/gynecology',
        'Occupational medicine', 'Ophthalmology', 'Orthopedic Surgery', 'Otolaryngology', 'Pediatrics',
        'Physical medicine and rehabilitation', 'Plastic surgery', 'Psychiatry', 'Public health and preventive medicine',
        'Radiation oncology', 'Respiratory medicine/respirology', 'Rheumatology', 'Urology',
      ]);
      $table->enum('position', ['Doctor', 'Certified Therapist', 'Medical Technician',]);
      $table->unique(['user_id', 'specialty']);

      $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
    });
  }

  public function down()
  {
    Schema::table('doctors', function(Blueprint $table){
      $table->dropForeign('doctors_user_id_foreign');
    });

    Schema::dropIfExists('doctors');
  }
}
