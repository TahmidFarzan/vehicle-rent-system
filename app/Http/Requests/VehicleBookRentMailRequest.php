<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleBookRentMailRequest extends FormRequest
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
           'subject' => array(
               'required'
              ),
              'message' => array(
               'required'
              ),
              'email' => array(
               'required',
               'max:50',
               'email'
              ),
              'admin' => array(
               'required',
               'max:50',
               'email'
              )     
        ];
    }

    public function messages()
     {
       return [
         'subject.required' => 'Subject url is required.',
         'message.required' => 'Message alt text is required.',
         'journey_date.required' => 'Journey date required.',
         'return_date.required' => 'Return date required.',
       ];
   }
}
