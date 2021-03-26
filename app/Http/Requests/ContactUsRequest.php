<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|max:100',
            'subject' => 'required|max:200',
            'email' => 'required|email|max:255',
            'phone_no' => 'required|numeric|digits_between:10,15',
            'message' => 'required'
        ];
    }

}
