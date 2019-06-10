<?php

use Faker\Generator as Faker;

$factory->define(CEM\Appointment::class, function (Faker $faker) {
  return [
    'patient_id' =>
      CEM\Patient::pluck('user_id')
      ->random(),
    'doctor_id' =>
      CEM\Doctor::pluck('id')
      ->random(),
    'time' => $faker->dateTimeBetween(
                '-2 months',
                '2 months',
                date_default_timezone_get()
              ),
    'type' => $faker->randomElement([
                'Check',
                'Consultation',
                'Therapy'
              ]),
    'reason' => $faker->sentence,
  ];
});
