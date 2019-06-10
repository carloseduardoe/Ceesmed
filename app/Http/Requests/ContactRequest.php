<?php

namespace CEM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
  public function authorize() {
    return true;
  }

  public function rules() {
    return [
      'user_id' => 'required|integer|min:1',
      'phone'   => 'nullable|numeric|digits_between:6,12',
      'mobile'  => 'nullable|numeric|digits_between:6,12',
      'address' => 'nullable|string|min:3',
      'city'    => 'nullable|string|min:3',
    ];
  }
}
