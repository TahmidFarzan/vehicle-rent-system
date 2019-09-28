<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventBookRentStoreRequest extends FormRequest
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
            'name' => array(
               'required',
               'max:100',
               'regex:/^[A-Za-z ]*$/'
              ),
            'mobile' => array(
               'required',
               'regex:/^[0-9 +,-]*$/',
               'max:112',
              ),
            'email' => array(
               'max:50',
               'required',
               'email'
              ),
            'description' => array(
               'required'
              ),
            'vehicle_amount' => array(
               'required',
               'numeric'
              ),
             'ticket_amount' => array(
               'required',
               'numeric'
              ),
            'vehicle_type' => array(
               'required',
               'numeric',
               'min:1',
               'max:9999999999'
              ),
            'event' => array(
               'required',
               'numeric',
               'min:1',
               'max:9999999999'
              ),
            'price' => array(
               'required',
               'max:11'
              ),
        ];
    }

    public function messages(){
       return [
         'mobile.regex' => 'Only number and + allow.',
         'vehicle_amount.required' => 'Vehicle amount required.',
         'ticket_amount.required' => 'Ticket amount required.',
         'vehicle_type.required' => 'Vehicle type required.',
       ];
   }
}
