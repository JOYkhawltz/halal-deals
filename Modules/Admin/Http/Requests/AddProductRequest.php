<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddProductRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required',
            'normal_price' => 'required|numeric',
            'brief_description' => 'required',
            'detailed_description' => 'required',
            'smallprint' => 'required',
            'actual_deal' => 'required',
            'vendor_id' => 'required'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    public function withValidator($validator) {
        $validator->after(function($validator) {
            if ($this->type=='') {
                $validator->errors()->add('type', 'select a Product Type.');
            }
            if ($this->sub_type=='') {
                $validator->errors()->add('sub_type', 'select a subType.');
            }
            if (!isset($this->AllImages['image'])) {
                $validator->errors()->add('image', 'The image field is required.');
            }
            if (isset($this->address_required) && $this->address_required == 1 && $this->postage_cost == "") {
                $validator->errors()->add('postage_cost', 'The postage cost field is required when address required is present.');
            }
        });
    }

}
