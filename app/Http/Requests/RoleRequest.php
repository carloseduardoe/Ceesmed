<?php

namespace CEM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
  public function authorize() {
    return true;
  }

  public function rules() {
    return [
      'user_id' => 'required|integer|min:1',
      'role_id' => 'required|integer|min:1',
    ];
  }
}
