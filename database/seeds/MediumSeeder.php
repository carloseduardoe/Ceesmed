<?php

use Illuminate\Database\Seeder;

class MediumSeeder extends Seeder
{
  public function run()
  {
    $ids = CEM\Record::pluck('id')->random(20);

    foreach ($ids as $id) {
      factory(CEM\Medium::class)->create([
        'record_id' => $id,
      ]);
    }
  }
}
