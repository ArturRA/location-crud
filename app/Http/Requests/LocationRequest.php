<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class LocationRequest extends FormRequest
{
  public function rules()
  {
    return [
      'name' => 'required|string',
      'slug' => [
        'required',
        'string',
        'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
        // Uncomment the following lines if needed:
        // function ($attribute, $value, $fail) {
        //     if ($value !== Str::slug($this->input('name'))) {
        //         $fail('The slug must correspond to the name.');
        //     }
        // }
      ],
      'city' => 'required|string',
      'state' => 'required|string',
    ];
  }

  protected function failedValidation(Validator $validator)
  {
    throw new HttpResponseException(response()->json($validator->errors(), 400));
  }
}
