<?php

namespace CEM;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
  public $timestamps = false;

  protected $primaryKey = 'user_id';

  protected $fillable = [
    'user_id', 'birthdate', 'gender', 'bloodtype', 'notes', 'viewhistory',
  ];

  public function user(){
    return $this->belongsTo(User::class, 'user_id');
  }

  public function hasRecords(){
    return $this->records()->count() > 0;
  }

  public function hasAppointments(){
    return $this->appointments()->count() > 0;
  }

  public function records(){
    return $this->hasMany(Record::class, 'patient_id');
  }

  public function appointments(){
    return $this->hasMany(Appointment::class, 'patient_id');
  }
}
