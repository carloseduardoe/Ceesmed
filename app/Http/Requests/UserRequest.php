<?php

namespace CEM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
  public function authorize() {
    return true;
  }

  public function rules() {
    return [
      'nid'    => 'digits_between:5,13',
      'name'   => 'required',
      'email'  => 'required',
      'active' => 'in:on',
    ];
  }
}
