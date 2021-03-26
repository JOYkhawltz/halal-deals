<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class RegisterRequest extends FormRequest {

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
            'type_id' => 'required',
            'first_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255',
            // 'phone' => 'nullable|min:10|max:20',
            'phone' => 'nullable',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            //&& !preg_match('/^[1-9][0-9]*$/', $this->phone)
            if (!empty($this->phone && !preg_match('/^[1-9][0-9]*$/', $this->phone)) ) {
                $validator->errors()->add('phone', 'Please give a proper phone number.');
            }
            $checkUser = User::where('email', $this->email)->first();
            if (count($checkUser) > 0)
                $validator->errors()->add('email', 'Email already in use.');
            if ($this->type_id == 3 && $this->business_name == "") {
                $validator->errors()->add('business_name', 'Business Name filed is required.');
            }
            if ($this->type_id == 3 && $this->address1 == "") {
                $validator->errors()->add('address1', 'Address1 filed is required.');
            }
            if ($this->type_id == 3 && $this->city == "") {
                $validator->errors()->add('city', 'City filed is required.');
            }
            if ($this->type_id == 3 && $this->postcode == "") {
                $validator->errors()->add('postcode', 'Postcode filed is required.');
            }
            if (!isset($this->terms_and_cond_agreed)) {
                $validator->errors()->add('terms_and_cond_agreed', 'Please accept terms and condition.');
            }
            if (strlen($this->phone) < 10) {
                $validator->errors()->add('phone', 'The contact number should be minimum of 10 numbers.');
            }elseif(strlen($this->phone) > 20){
                $validator->errors()->add('phone', 'The contact number should be maximum of 20 numbers.');
            }
        });
    }

}
