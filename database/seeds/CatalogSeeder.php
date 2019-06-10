<?php

use CEM\Catalog;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
  public function run() {
    $contents = [
      'doctorlink1World Health Organization'                 => 'http://www.who.int',
      'doctorlink2Centers for Disease Control'               => 'https://www.cdc.gov',
      'doctorlink3U.S. National Library of Medicine'         => 'https://www.nlm.nih.gov',
      'doctorlink4European Health for All database (HFA-DB)' => 'https://gateway.euro.who.int/en/datasets/european-health-for-all-database',
    ];

    foreach ($contents as $key => $value) {
      Catalog::create(['key' => $key, 'value' => $value]);
    }
  }
}
