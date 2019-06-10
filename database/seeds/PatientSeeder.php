<?php

use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
  public function run()
  {
    $ids = CEM\User::pluck('id');

    foreach ($ids as $id) {
      factory(CEM\Patient::class)->create([
        'user_id' => $id
      ]);

      CEM\User::find($id)
      ->roles()
      ->attach(
        CEM\Role::where('name', 'patient')->first()
      );
    }
  }
}
