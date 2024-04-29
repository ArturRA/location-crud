<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LocationStoreRequest extends FormRequest
{
  public function rules() {
    return [
      'name' => 'required|string',
      'slug' => 'required|string',
      'city' => 'required|string',
      'state' => 'required|string',
    ];
  }

  protected function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(response()->json($validator->errors(), 400));
  }
}
