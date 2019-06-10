<?php

use Faker\Generator as Faker;

$factory->define(CEM\Schedule::class, function (Faker $faker) {
  static $minutes = ['00',15,30,45];
  $start = rand(0,21);
  do {
    $end = $start + rand(1,7);
  } while ($end > 23);

  return [
    'doctor_id' => CEM\Doctor::pluck('id')->random(),
    'day' => array(
        'mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun',
      )[rand(0,6)],
    'start' => $start.':'.$minutes[rand(0,3)],
    'end' => $end.':'.$minutes[rand(0,3)]
  ];
});
