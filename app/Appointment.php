<?php

namespace CEM;

use CEM\Schedule;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
  public $timestamps = false;

  protected $primaryKey = 'id';

  protected $fillable = [
    'doctor_id', 'patient_id', 'time', 'type', 'reason',
  ];

  public function doctor() {
    return $this->belongsTo(Doctor::class, 'doctor_id');
  }

  public function patient() {
    return $this->belongsTo(Patient::class, 'patient_id');
  }

  public function validate() {
    $time = Carbon::parse($this->time);

    $appc = Appointment::where('doctor_id',  $this->doctor_id)
    ->whereBetween('time', [
      $time->copy()->subMinutes(15)->toDateTimeString(),
      $time->copy()->addMinutes(15)->toDateTimeString()
    ])->count();

    return $appc == 0;
  }

  public function onSchedule() {
    $time = Carbon::parse($this->time);
    $schc = Schedule::where('doctor_id',  $this->doctor_id)
    ->where('day',   Appointment::toDayString($time->dayOfWeek))
    ->where('start', '<=', $time->hour.':'.$time->minute)
    ->where('end',   '>=', $time->hour.':'.$time->minute)
    ->count();

    return $schc == 1;
  }

  public static function toDayString(int $day) {
    $val = -1;
    switch ($day) {
      case 0: $val = 'sun'; break;
      case 1: $val = 'mon'; break;
      case 2: $val = 'tue'; break;
      case 3: $val = 'wed'; break;
      case 4: $val = 'thu'; break;
      case 5: $val = 'fri'; break;
      case 6: $val = 'sat'; break;
    }
    return $val;
  }
}
