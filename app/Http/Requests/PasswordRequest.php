<?php

namespace CEM\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
{
  public function authorize() {
    return true;
  }

  public function rules(){
    return [
      'current'          => 'required',
      'new'              => 'required|string|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*[\w])[a-zA-Z\d$@#!%*?&].+$/|min:6|max:20|confirmed',
      'new_confirmation' => 'required|same:new',
    ];
  }
}
