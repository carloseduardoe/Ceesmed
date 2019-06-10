<?php

use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
  public function run()
  {
    $ids = CEM\User::pluck('id');

    foreach ($ids as $id) {
      factory(CEM\Contact::class)->create([
        'user_id' => $id
      ]);
    }
  }
}
