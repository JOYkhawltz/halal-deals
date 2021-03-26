<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\Business;

class VendorRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'first_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255',
            'name' => 'max:255',
            'town' => 'max:50',
            'city' => 'max:50',
            'post_code' => 'nullable|max:20',
            'telphone_no' => 'nullable|min:8|max:50',
            'contact_name' => 'max:255',
            'contact_no' => 'nullable|min:8|max:50',
            'commission_type' => 'required',
            'commission_rate' => 'nullable|numeric'
            //            'commission_type' => "required_with:commission_rate|required_with:additional_rate",
        ];
    }

    public function withValidator($validator) {
        $validator->after(function($validator) {
            $town = str_replace(' ', '', $this->town);
            if (!empty($this->town) && !ctype_alpha($town)) {
                $validator->errors()->add('town', 'Please give a proper town name.');
            }
            $city = str_replace(' ', '', $this->city);
            if (!empty($this->city) && !ctype_alpha($city)) {
                $validator->errors()->add('city', 'Please give a proper city name.');
            }
            if (!empty($this->telphone_no) && !preg_match('/^[1-9][0-9]*$/', $this->telphone_no)) {
                $validator->errors()->add('telphone_no', 'Please give a proper telephone number.');
            }
            if (!empty($this->contact_no) && !preg_match('/^[1-9][0-9]*$/', $this->contact_no)) {
                $validator->errors()->add('contact_no', 'Please give a proper contact number.');
            }
            if (!empty($this->phone) && !preg_match('/^[1-9][0-9]*$/', $this->phone)) {
                $validator->errors()->add('contact_no', 'Please give a proper phone number.');
            }
            if (!empty($this->post_code) && !preg_match('/^[1-9][0-9]*$/', $this->post_code)) {
                $validator->errors()->add('post_code', 'Please give a proper post code.');
            }
            $checkUser = User::where('id', '<>', $this->id)->where('email', $this->email)->first();
            if (count($checkUser) > 0)
                $validator->errors()->add('email', 'Email already in use.');
            $checkBusiness = Business::where('user_id', '<>', $this->id)->where('name', $this->name)->first();
            if (count($checkBusiness) > 0)
                $validator->errors()->add('name', 'Name already in use.');
            if ($this->commission_type == 1) {
                if(empty($this->commission_rate)){
                    $validator->errors()->add('commission_rate', 'Commission rate is required');
                }
            if ($this->commission_rate <= 8) {
                $validator->errors()->add('commission_rate', 'Given commission rate must be greater then 8 %');
            }
            if ($this->commission_rate >=100) {
                $validator->errors()->add('commission_rate', 'Given commission rate is high');
            }
            }
        });
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

}
