<?php

namespace CEM\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class RecordRequest extends FormRequest
{
  public function authorize(){
    return true;
  }

  public function rules(){
    $rules = [
      'patient_id'   => Route::currentRouteName() == 'records.create' ? 'required|' : '' . 'integer|min:1',
      'description'  => 'required|min:10|max:4000',
      'diagnosis'    => 'required|min:10|max:1000',
      'prescription' => 'required|min:10|max:4000',

      'pulse'       => 'nullable|numeric|integer|between:40,150',
      'bpsystolic'  => 'nullable|numeric|min:1',
      'bpdiastolic' => 'nullable|numeric|min:1',
      'temperature' => 'nullable|numeric|min:1',
      'weight'      => 'nullable|numeric|min:1',
      'height'      => 'nullable|numeric|min:1',
    ];

    $file = count($this->input('file'));
    foreach(range(0, $file) as $index) {
      $rules['file.'.$index] = 'mimetypes:application/pdf,image/bmp,image/jpeg,image/jpg,image/gif,image/png,video/avi,video/quicktime,video/mpeg,video/mp4|max:51200';
    }

    return $rules;
  }
}
