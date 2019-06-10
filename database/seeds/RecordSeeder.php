<?php

use Illuminate\Database\Seeder;

class RecordSeeder extends Seeder
{
  public function run()
  {
    factory(CEM\Record::class, 100)->create();
  }
}
