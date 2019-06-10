<?php

namespace CEM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
{
  public function authorize() {
    return true;
  }

  public function rules() {
    return [
      'user_id'     => 'required|integer|min:1',
      'birthdate'   => 'required|date|before_or_equal:now|after_or_equal:1900/01/01',
      'gender'      => 'required|in:m,f,*|size:1',
      'bloodtype'   => 'required|in:A +,A -,A *,B +,B -,B *,AB+,AB-,AB*,O +,O -,O *,*',
      'viewhistory' => 'in:on',
    ];
  }
}
