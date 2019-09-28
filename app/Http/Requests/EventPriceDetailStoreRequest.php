<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventPriceDetailStoreRequest extends FormRequest
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
            'vehicle_price' => array(
               'required',
               'numeric',
               'max:9999999999'
              ),
            'total_price' => array(
               'required',
               'numeric',
               'max:9999999999'
              ),
            'ticket_price' => array(
               'required',
               'numeric',
               'max:9999999999'
              ),
              'vehicle_type' => array(
               'required',
               'numeric',
               'max:9999999999'
              ),
            'event' => array(
               'required',
               'numeric',
               'max:9999999999'
              ),
        ];
    }

     public function messages()
     {
       return [
         'vehicle_type.required' => 'Vehicle type is required.',
         'event.required' => 'Event is required.',
         'vehicle_price.required' => 'Vehicle price is required.',
         'total_price.required' => 'Total price is required.',
         'ticket_price.required' => 'Ticket price is required.',
       ];
   }
}
