<?php

namespace CEM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvatarRequest extends FormRequest
{
  public function authorize() {
    return true;
  }

  public function rules() {
    return [
      'avatar.0' => 'mimetypes:image/jpeg,image/jpg,image/png|max:2048',
    ];
  }
}
