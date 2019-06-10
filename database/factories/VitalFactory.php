<?php

use Faker\Generator as Faker;

$factory->define(CEM\Vital::class, function (Faker $faker) {
  return [
    'record_id' => CEM\Record::pluck('id')->random(),
    'pulse' => $faker->numberBetween(60, 100),
    'bpsystolic' => $faker->randomFloat(2, 100, 160),
    'bpdiastolic' => $faker->randomFloat(2, 60, 100),
    'temperature' => $faker->randomFloat(2, 36, 37),
    'weight' => $faker->randomFloat(2, 4, 90),
    'height' => $faker->randomFloat(2, 30, 210),
  ];
});
