<?php

use Faker\Generator as Faker;

$factory->define(CEM\Medium::class, function (Faker $faker) {
    return [
      'record_id' => CEM\Record::pluck('id')->random(),
      'path' => $faker->sentence,
      'mime' => $faker->mimeType,
    ];
});
