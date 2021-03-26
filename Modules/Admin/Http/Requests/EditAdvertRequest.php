<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Setting;

class EditAdvertRequest extends FormRequest {

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
            'title' => 'required|max:30',
            'advert_type' => 'required',
            'prod_ID' => 'required',
//            'date_start' => 'required|date_format:d-m-Y',
//            'date_finish' => 'required|date_format:d-m-Y|after:date_start',
            'deal_start' => 'required_if:advert_type,==,deal',
            'deal_end' => 'required_if:advert_type,==,deal',
            'smallprint' => 'required',
            'coupen_discount' => 'required|numeric',
        ];
    }

    public function messages() {
        return[
            'prod_ID.required' => 'Please select at least one product.'
        ];
    }

    public function withValidator($validator) {
        $validator->after(function($validator) {
            if (isset($this->advert_type)) {
                if ($this->advert_type == 'voucher') {
                    if ($this->v_exp_date == '') {
                        $validator->errors()->add('v_exp_date', 'voucher expiry date is required .');
                    } elseif (!(is_numeric($this->v_exp_date))) {
                        $validator->errors()->add('v_exp_date', 'voucher expiry date is not neumeric.');
                    }
                }
            }
            if (isset($this->coupen_discount)) {
                $selling_percent = Setting::where('slug', 'selling_percentage')->first();
                if ($this->coupen_discount <= ($selling_percent['value']))
                    $validator->errors()->add('coupen_discount', 'coupen discount must be greater than 8%.');
                if ($this->coupen_discount >= 100)
                    $validator->errors()->add('coupen_discount', 'given commision rate high.');
            }
            if (isset($this->additional_discount)) {
                if (!(is_numeric($this->additional_discount)))
                    $validator->errors()->add('additional_discount', 'given addtional rate is not neumeric.');
                $sum = ($this->coupen_discount) + ($this->additional_discount);
                if ($sum >= 100)
                    $validator->errors()->add('additional_discount', 'given addtional rate high.');
            }
            if (isset($this->spec_times) && $this->spec_times == 1) {
                if ($this->spec_times_details == "") {
                    $validator->errors()->add('spec_times_details', 'Please give a specfic times.');
                } else if (strlen($this->spec_times_details) > 20) {
                    $validator->errors()->add('spec_times_details', 'Please give a value wioth in 20 words.');
                }
            }
        });
    }

}
