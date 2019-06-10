<?php

use Faker\Generator as Faker;

function sequenceGen(Faker $faker, $length = 10) {
  $holder = '';
  for ($i=0; $i < $length; $i++) {
    $holder .= $faker->randomDigit;
  }
  return $holder;
}

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CEM\User::class, function (Faker $faker) {
  static $password;

  return [
    'nid'            => sequenceGen($faker),
    'name'           => $faker->name,
    'email'          => $faker->unique()->safeEmail,
    'password'       => $password ? $password : bcrypt('secret'),
    'remember_token' => str_random(10),
    'active'         => false,
  ];
});
