<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleRentPriceStoreRequest extends FormRequest
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
           'total_price' => array(
               'required',
               'numeric',
               'max:9999999999'
              ),
           'rent_price' => array(
               'required',
               'numeric',
               'max:9999999999'
              ),
           'distance_price' => array(
               'required',
               'numeric',
               'max:9999999999'
              ),
              'vehicle_type' => array(
               'required',
               'numeric',
               'max:9999999999'
              ),
            'route' => array(
               'required',
               'numeric',
               'max:9999999999'
              ),
        ];
    }

    public function messages()
     {
       return [
         'total_price.required' => 'Total Price is required.',
         'rent_price.required' => 'Rent price is required.',
         'distance_price.required' => 'Distance price is required.',
         'vehicle_type.required' => 'Vehicle type is required.',
         'route.required' => 'Route is required.',
       ];
   }
}
