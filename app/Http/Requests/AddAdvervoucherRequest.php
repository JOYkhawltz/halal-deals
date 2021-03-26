<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Setting;

class AddAdvervoucherRequest extends FormRequest {

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
            'v_amount' => 'required|numeric',
            'total_voucher' => 'required|numeric',
            'title' => 'required|max:30',
            'voucher_expiery' => 'required',
//            'date_start' => 'required|date_format:d-m-Y',
//            'date_finish' => 'required|date_format:d-m-Y|after:date_start',
            'smallprint' => 'required',
        ];
    }
public function messages() {
        return[
            'v_amount.required' => 'Please give voucher amount.',
            'total_voucher.required' => 'Give total number number of voucher.',
            'voucher_expiery.required' => 'Enter voucher expiery.',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function($validator) {
            
            if (isset($this->spec_times) && $this->spec_times == 1) {
                if ($this->date_start == "") {
                    $validator->errors()->add('date_start', 'Please give a start Date.');
                } 

            }
        });
    }

}
