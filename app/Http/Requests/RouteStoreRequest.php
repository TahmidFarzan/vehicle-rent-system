<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouteStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
          'destination' => array(
               'required'
            ),
          'origin' => array(
               'required'
              ),
          'time' => array(
               'required',
               'regex:/^[A-Za-z0-9 ]+$/'
              ), 
          'distance' => array(
               'required',
               'regex:/^\d*(\.\d{2})?$/'
              )
        ];
    }

    public function messages()
     {
       return [
         'time.required' => 'Time is required.',
         'distance.required' => 'Distance is required.',
         'distance.regex' => 'Only number or float allow with two digits after point(.).',
       ];
   }
}
