<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsStoreRequest extends FormRequest
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
            'email' => array(
               'required',
               'max:50',
               'string',
               'email'
              ),
            'office' => array(
               'required',
               'regex:/^[A-Za-z ]*$/',
               'max:100'
              ),
            'address' => array(
               'required'
              ),
             'cell' => array(
               'required',
               'regex:/^[0-9,+]*$/',
               'max:112'
              )
        ];
    }

     public function messages()
     {
       return [
         'office.regex' => 'Latter and space allow.',
         'cell.regex' => 'Office cell Must be a mobile no.',
       ];
   }
}
