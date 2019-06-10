<?php

use Illuminate\Database\Seeder;

use CEM\Role;

class RoleSeeder extends Seeder
{
  public function run()
  {
    $roles = [
      'patient' => 'A patient.',
      'doctor' => 'A doctor.',
      'agent' => 'Counterperson or office attendant.',
      'admin' => 'System administrator.'
    ];

    foreach ($roles as $name => $description) {
      Role::create([
        'name' => $name,
        'description' => $description,
      ]);
    }
  }
}
