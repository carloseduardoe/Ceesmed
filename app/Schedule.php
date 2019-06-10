<?php

namespace CEM;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
  public $timestamps = false;

  protected $fillable = [
    'doctor_id', 'day', 'start', 'end'
  ];

  public function doctor() {
    return $this->belongsTo(Doctor::class, 'doctor_id');
  }

  public function overlaps() {
    return Schedule::where('doctor_id', $this->doctor_id)
    ->where('day', $this->day)
    ->where(function($query) {
      $query->where(function($q) {
        $q
        ->where('start', '<=', $this->start)
        ->where('end',   '>=', $this->start);
      })
      ->orWhere(function($q) {
        $q
        ->where('start', '<=', $this->start)
        ->where('end',   '>=', $this->end);
      })
      ->orWhere(function($q) {
        $q
        ->where('start', '>=', $this->start)
        ->where('end',   '<=', $this->end);
      })
      ->orWhere(function($q) {
        $q
        ->where('start', '<=', $this->end)
        ->where('end',   '>=', $this->end);
      });
    })->count() > 0;
  }
}
