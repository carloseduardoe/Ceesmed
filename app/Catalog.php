<?php

namespace CEM;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
  public $timestamps = false;

  protected $fillable = [
    'key', 'value'
  ];
}
