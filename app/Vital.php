<?php

namespace CEM;

use Illuminate\Database\Eloquent\Model;

class Vital extends Model
{
  public $timestamps = false;

  protected $primaryKey = 'record_id';

  protected $fillable = [
    'record_id', 'pulse', 'bpsystolic', 'bpdiastolic', 'temperature', 'weight', 'height'
  ];

  public function record(){
    return $this->belongsTo(Record::class, 'record_id');
  }
}
