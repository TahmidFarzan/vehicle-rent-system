<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventDetailUpdateRequest extends FormRequest
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
            'start_time' => array(
               'required',
               'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^'
              ),
             'start_date' => array(
               'required',
               'date'
              ),
              'end_time' => array(
               'required',
               'regex:^(([0-1][0-9]|2[0-3]):[0-5][0-9](:[0-5][0-9])?)$^'
              ),
             'end_date' => array(
               'required',
               'date'
              ),
             'name' => array(
               'required',
               'max:100',
               'regex:/^[A-Za-z0-9-_  ]*$/'
              ),
            'type' => array(
               'required',
               'numeric',
               'min:1',
               'max:9999999999'
              ),
            'address' => array(
               'required'
              ),
            'descriptaion' => array(
               'required'
              ),
            'map' => array(
               'required',
               'url' 
              ),
            'organizar' => array(
               'required'
              ),
            'patner' => array(
               'nullable'
              ),
            'image' => array(
               'mimes:jpeg,png,jpg',
               'dimensions:min_width=450,min_height=250,max_width=450,max_height=250'
              )
        ];
    }

     public function messages(){
       return [
         'start_date.date' => 'Start date must valid date (YYYY-MM-DD).',
         'start_time.regex' => 'Start time Must a valid format within 24hr.',
         'end_date.date' => 'End date must valid date (YYYY-MM-DD).',
         'end_date.required' => 'End time is required.',
         'end_time.regex' => 'Start time Must a valid format within 24hr.',
         'end_date.required' => 'End date is required.',
         'name.regex' => 'Only alphanumerical with -_ and space allow.',
         'type.max' => 'Max char is 10.',
         'image.dimensions' => 'Image demention must be 450x250.',
       ];
   }
}
