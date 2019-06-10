<?php

namespace CEM;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
  public $timestamps = false;

  protected $primaryKey = 'id';

  protected $fillable = [
    'user_id', 'specialty', 'position',
  ];

  public function user(){
    return $this->belongsTo(User::class, 'user_id');
  }

  public function schedules(){
    return $this->hasMany(Schedule::class, 'doctor_id');
  }

  public function appointments(){
    return $this->hasMany(Appointment::class, 'doctor_id');
  }
}
