<?php

use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
  public function run()
  {
    factory(CEM\Appointment::class, 20)->create();
  }
}
