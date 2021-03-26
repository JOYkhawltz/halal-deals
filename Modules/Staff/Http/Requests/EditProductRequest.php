<?php

namespace Modules\Staff\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
//            'name' => 'required',
            'price_verified' => 'required|numeric',
//            'normal_price' => 'required|numeric',
//            'brief_description' => 'required',
//            'detailed_description' => 'required',
//            'smallprint' => 'required',
//            'actual_deal' => 'required'
        ];
    }

//    public function withValidator($validator) {
//        $validator->after(function($validator) {
//            if (!isset($this->AllImages['image'])) {
//                $validator->errors()->add('image', 'The image field is required.');
//            }
//            if (isset($this->address_required) && $this->address_required == 1 && $this->postage_cost=="") {
//                $validator->errors()->add('postage_cost', 'The postage cost field is required when address required is present.');
//            }
//        });
//    }
}
