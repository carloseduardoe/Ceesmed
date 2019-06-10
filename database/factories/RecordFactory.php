<?php

use Faker\Generator as Faker;

$factory->define(CEM\Record::class, function (Faker $faker) {
  return [
    'patient_id'   => CEM\Patient::pluck('user_id')->random(),
    'description'  => $faker->sentence,
    'diagnosis'    => $faker->paragraph(4, true),
    'prescription' => $faker->paragraph(3, true),
    'created_at'   => $faker->dateTime($max = 'now', $timezone = null),
  ];
});
