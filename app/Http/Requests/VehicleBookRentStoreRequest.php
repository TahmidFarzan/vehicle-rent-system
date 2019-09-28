<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleBookRentStoreRequest extends FormRequest
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
            'journey_date' => array(
               'required',
               'date'
              ),
            'return_date' => array(
               'required',
               'date'
              ),
            'description' => array(
               'required'
              ),
            'vehicle_amount' => array(
               'required',
               'numeric'
              ),
            'vehicle_type' => array(
               'required',
               'numeric',
               'min:1',
               'max:9999999999'
              ),
            'route' => array(
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
         'name.required' => 'User name required.',
         'mobile.required' => 'User Mobile no is required.',
         'mobile.regex' => 'Only number and +1- allow.',
         'email.required' => 'User email required.',
         'journey_date.required' => 'Journey date required.',
         'return_date.required' => 'Return date required.',
         'take_off_address.required' => 'Take off address date required.',
         'vehicle_amount.required' => 'Vehicle amount required.',
         'vehicle_type.required' => 'Vehicle type required.',
         'route.required' => 'Route required.',
         'price.required' => 'Price required.',
       ];
   }
}
