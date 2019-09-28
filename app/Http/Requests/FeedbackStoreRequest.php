<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackStoreRequest extends FormRequest
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
              ),
            'email' => array(
               'required',
               'max:50',
               'string',
               'email'
              ),
            'message' => array(
               'required'
              )
        ];
    }
}
