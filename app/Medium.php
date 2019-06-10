<?php

namespace CEM;

use CEM\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Medium extends Model
{
  public $timestamps = false;

  protected $fillable = [
    'record_id', 'path', 'mime',
  ];

  public function record() {
    return $this->belongsTo(Record::class, 'record_id');
  }

  public function obtain(){
    $path = 'patients/'.User::find($this->record->patient_id)->id.'/';
    return Storage::download($path.$this->path);
  }

  public function vanish() {
    return Storage::delete('patients/'.User::find($this->record->patient_id)->id.'/'.$this->path);
  }
}
