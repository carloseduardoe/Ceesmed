<?php

namespace CEM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ScheduleRequest extends FormRequest
{
  public function authorize() {
    return true;
  }

  public function rules() {
    return [
      'doctor_id' => 'required',
      'day'       => 'required|in:mon,tue,wed,thu,fri,sat,sun',
      'start'     => 'required|date_format:H:i',
      'end'       => 'required|date_format:H:i|after:start',
    ];
  }
}
