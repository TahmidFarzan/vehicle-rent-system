<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\HomeSlider;

class HomeSliderStoreRequest extends FormRequest
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
              'url' => array(
               'required',
               'url',
               'distinct'
              ),
              'slider_sequence' => array(
               'required',
               'numeric',
               'min:1',
               'max:9999999999',
               'unique:home_sliders'
              ),
              'alt_text' => array(
               'required',
               'max:100',
               'distinct',
               'regex:/^[A-Za-z .]*$/'
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
         'url.required' => 'Image url is required.',
         'url.url' => 'Only url allow.',
         'slider_sequence.required' => 'Image sequence is required.',
         'slider_sequence.min' => 'Start point must be 1.',
         'image.dimensions' => 'Image demention must be 450x450.',
         'alt_text.required' => 'Image alt text is required.',
         'alt_text.regex' => 'Latter characters with space fullstop are allow.',
         'alt_text.max' => 'Max char 100.',
         
       ];
   }
}
