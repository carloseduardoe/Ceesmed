<?php

use Illuminate\Database\Seeder;

use CEM\User;

class UserSeeder extends Seeder
{
  public function run()
  {
    $user = User::create([
      'id'             => '1',
      'nid'            => '0000000000',
      'name'           => env('ADMIN_NAME'),
      'email'          => env('ADMIN_EMAIL'),
      'password'       => bcrypt('admin'),
      'remember_token' => str_random(10),
      'active'         => true,
    ]);
    $user->roles()->attach(CEM\Role::where('name', 'admin')->first());
    //on production also create as patient and contact info

    factory(CEM\User::class, 9)->create();
  }
}
