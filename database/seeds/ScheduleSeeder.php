<?php

use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
  public function run()
  {
    factory(CEM\Schedule::class, 5)->create();
  }
}
