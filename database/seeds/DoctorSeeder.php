<?php

use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
  public function run()
  {
    $ids = CEM\User::all()->random(4)->pluck('id');

    foreach ($ids as $id) {
      factory(CEM\Doctor::class)->create([
        'user_id' => $id,
      ]);

      CEM\User::find($id)
        ->roles()
        ->attach(CEM\Role::where('name', 'doctor')
        ->first());
    }
  }
}
