<?php

use Faker\Generator as Faker;

$factory->define(CEM\Contact::class, function (Faker $faker) {
  return [
    'user_id' =>
      CEM\User::whereNotIn('id', CEM\Contact::pluck('user_id'))
      ->pluck('id')
      ->random(),
    'phone'   => sequenceGen($faker, 9),
    'mobile'  => sequenceGen($faker, 10),
    'address' => $faker->address,
    'city'    => $faker->city,
  ];
});
