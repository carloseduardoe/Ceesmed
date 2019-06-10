<?php

namespace CEM;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  public $timestamps = false;

  protected $primaryKey = 'user_id';

  protected $fillable = [
    'user_id', 'phone', 'mobile', 'address', 'city',
  ];
}
