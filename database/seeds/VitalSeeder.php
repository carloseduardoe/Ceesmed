<?php

use Illuminate\Database\Seeder;

class VitalSeeder extends Seeder
{
  public function run()
  {
    $ids = CEM\Record::pluck('id');

    foreach ($ids as $id) {
      factory(CEM\Vital::class)->create([
        'record_id' => $id,
      ]);
    }
  }
}
