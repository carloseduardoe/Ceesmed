<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
  public function run()
  {
    $this->call(RoleSeeder::class);
    $this->call(UserSeeder::class);
    $this->call(ContactSeeder::class);
    $this->call(PatientSeeder::class);
    $this->call(DoctorSeeder::class);
    $this->call(AppointmentSeeder::class);
    $this->call(RecordSeeder::class);
    $this->call(ScheduleSeeder::class);
    $this->call(VitalSeeder::class);
    // $this->call(MediumSeeder::class);
    $this->call(CatalogSeeder::class);
  }
}
