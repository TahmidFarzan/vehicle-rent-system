<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackReplyRequest extends FormRequest
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
              ) ,
              'email' => array(
               'required',
               'email'
              ),
              'admin' => array(
               'required',
               'email'
              ),
              'id' => array(
               'required',
               'numeric',
               'min:0'
              )             
          ];
    }

    public function messages()
     {
       return [
         'subject.required' => 'Subject url is required.',
         'message.required' => 'Message alt text is required.',
       ];
   }
}
