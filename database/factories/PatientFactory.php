<?php

use Faker\Generator as Faker;

$factory->define(CEM\Patient::class, function (Faker $faker) {
  return [
    'user_id' => CEM\User::pluck('id')->random(),
    'birthdate' => $faker->dateTimeThisDecade(),
    'gender' => $faker->randomElement(['m', 'f', '*']),
    'bloodtype' => $faker->randomElement([
      'A +', 'A -', 'A *', 'B +', 'B -', 'B *',
      'AB+', 'AB-', 'AB*', 'O +', 'O -', 'O *',
      '*',
    ]),
    'viewhistory' => false,
  ];
});
