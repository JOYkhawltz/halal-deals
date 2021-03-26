<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Discount;

class UpdateDiscountRequest extends FormRequest {

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
            'discount_rate' => 'required|numeric|between:0,99.99',
            'name' => 'required|max:100',
            'status' => 'required'
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            $checkDiscountName = Discount::where('name', $this->name)->where('id', '<>', base64_decode($this->id))->where('status', '1')->first();
            if (!empty($checkDiscountName)) {
                $validator->errors()->add('name', 'Discount name already exists.');
            }
            if(is_numeric($this->discount_rate)){
            $checkDiscountRate = Discount::where('discount_rate', number_format($this->discount_rate,2))->where('id', '<>', base64_decode($this->id))->where('status', '1')->first();
            if (!empty($checkDiscountRate)) {
                $validator->errors()->add('discount_rate', 'Discount rate already exists.');
            }
            }else{
              $validator->errors()->add('discount_rate', 'Discount rate must be a number.');  
            }
        });
    }

}
