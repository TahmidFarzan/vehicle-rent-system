<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehicleDetailUpdateRequest extends FormRequest
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
               'regex:/^[A-Za-z0-9-_  ]*$/',
               'max:50',
               'distinct'
              ),
            'type' => array(
               'required',
               'numeric',
               'min:1',
               'max:9999999999'
              ),
            'seat' => array(
               'required',
               'numeric',
               'min:0',
               'max:60'
              ),
            'licence_no' => array(
               'required',
               'regex:/^[A-Za-z0-9 :-]*$/',
               'max:50',
               'distinct'
              ),
            'image' => array(
               'mimes:jpeg,png,jpg',
               'dimensions:min_width=450,min_height=250,max_width=450,max_height=250'
              ),
        ];
    }

    public function messages()
     {
       return [
         'name.regex' => 'Only alphanumerical with -_ and space allow.',
         'licence_no.required' => 'Vehicle licence no is required.',
         'licence_no.regex' => 'Only alphanumerical with space : - allow .',
         'image.dimensions' => 'Image demention must be 450x250.',
       ];
   }
}
