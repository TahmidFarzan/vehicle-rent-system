<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceStoreRequest extends FormRequest
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
               'regex:/^[A-Za-z ]*$/',
               'max:100'
              ),
            'description' => array(
               'required'
              ),
            'image' => array(
               'required',
               'mimes:jpeg,png,jpg',
               'dimensions:min_width=450,min_height=450,max_width=450,max_height=450'
              ),
        ];
    }

    public function messages()
     {
       return [
         'image.dimensions' => 'Image demention must 450x450.',
         'name.regex' => 'Latter and space allow.',
       ];
   }
}
