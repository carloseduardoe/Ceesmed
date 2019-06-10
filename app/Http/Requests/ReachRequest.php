<?php

namespace CEM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReachRequest extends FormRequest
{
  public function authorize() {
    return true;
  }

  public function rules() {
    return [
      'name'    => 'required|min:10|max:50',
      'email'   => 'required|email',
      'phone'   => 'required|numeric|digits_between:7,10',
      'message' => 'required|min:10|max:200'
    ];
  }
}
