<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CardRequest extends FormRequest {

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
            'card_type' => 'required',
            'full_name' => 'required',
            'number' => 'required',
            'expiry' => 'required',
            'cvc' => 'required|integer',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            $card_number = str_replace(" ", "", $this->number);
            if (strlen($card_number) != 16) {
                $validator->errors()->add('number', 'Please give a prorper card number.');
            }
            $expiry = explode("/", $this->expiry);
            if (isset($expiry[1]) && strlen(trim($expiry[1])) !== 4) {
                $validator->errors()->add('expiry', 'Invalid expiry date.');
            }
            if($this->card_type=="")
            {
                $validator->errors()->add('number', 'Invalid card number.');
            }
        });
    }

}
