<?php

namespace CEM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
  public function authorize() {
    return true;
  }

  public function rules() {

    return [
      'doctor_id'  => 'required|integer|min:1',
      'patient_id' => 'required|integer|min:1',
      'time0'      => 'required|date|before_or_equal:+5 years|after_or_equal:today',
      'time1'      => 'required|date_format:H:i',
      'type'       => 'required',
      'reason'     => 'required|min:10|max:200',
    ];
  }

  public function messages()
  {
    return [
      'time0.required'        => 'A date is required',
      'time0.before_or_equal' => 'Selected date must be in less than 5 years.',
      'time0.after_or_equal'  => 'Selected date must be in the future.',
      'time1.required'        => 'A time is required',
    ];
  }
}
