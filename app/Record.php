<?php

namespace CEM;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
  protected $fillable = [
    'patient_id', 'description', 'diagnosis', 'prescription',
  ];

  public function patient(){
    return $this->belongsTo(Patient::class, 'user_id', 'patient_id');
  }

  public function vitals(){
    return $this->hasOne(Vital::class, 'record_id');
  }

  public function media(){
    return $this->hasMany(Medium::class, 'record_id');
  }
}
