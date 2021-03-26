<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\User;
use App\Business;

class CustomerEditprofileRequest extends FormRequest {

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
            'first_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
            'last_name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|min:8|max:20',
            'image' => 'mimes:jpeg,jpg,png|max:10000',
            'name' => 'max:255',
            'town' => 'max:50',
            'city' => 'max:50',
            'post_code' => 'nullable|min:6|max:20',
            'telphone_no' => 'nullable|min:8|max:50',
            'contact_name' => 'max:255',
            'contact_no' => 'nullable|min:8|max:50',
            'town_cust' => 'max:90',
            'city_cust' => 'max:90',
            'post_code_cust' => 'min:6|max:20',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            $town = str_replace(' ', '', $this->town);
            if (!empty($this->town) && !ctype_alpha($town)) {
                $validator->errors()->add('town', 'Please give a proper town name.');
            }
            $city = str_replace(' ', '', $this->city);
            if (!empty($this->city) && !ctype_alpha($city)) {
                $validator->errors()->add('city', 'Please give a proper city name.');
            }
            if (!empty($this->telphone_no) && !preg_match('/^[1-9][0-9]*$/', $this->telphone_no)) {
                $validator->errors()->add('telphone_no', 'Please enter a valid telephone number.');
            }
            if (!empty($this->contact_no) && !preg_match('/^[1-9][0-9]*$/', $this->contact_no)) {
                $validator->errors()->add('contact_no', 'Please give a proper contact number.');
            }
            if (!empty($this->phone) && !preg_match('/^[1-9][0-9]*$/', $this->phone)) {
                $validator->errors()->add('phone', 'Please give a proper phone number.');
            }
            if (!empty($this->post_code) && !preg_match('/^[1-9][0-9]*$/', $this->post_code)) {
                $validator->errors()->add('post_code', 'Please enter a valid post code.');
            }
            $user = User::findOrFail(Auth::guard('frontend')->user()->id);
            if ($user->email !== $this->email) {
                $checkUser = User::where('email', $this->email)->first();
                if (count($checkUser) > 0)
                    $validator->errors()->add('email', 'Email already in use.');
            }
            if ($user->type_id === '3') {
                $business = Business::where('user_id', $user->id)->first();
                if(!empty($this->name))
                {
                    if ($business->name !== $this->name) {
                        $checkName = Business::where('name', $this->name)->first();
                        if (count($checkName) > 0)
                            $validator->errors()->add('name', 'Name already in use.');
                    }
                }else{
                    $validator->errors()->add('name', 'Name is required.');
                }
                if(empty($this->address1)){
                    $validator->errors()->add('address1', 'Address1 is required');
                }
                if(empty($this->city)){
                    $validator->errors()->add('city', 'City is required');
                }
                if(empty($this->contact_no)){
                    $validator->errors()->add('contact_no', 'Contact No is required');
                }
                if(empty($this->post_code)){
                    $validator->errors()->add('post_code', 'Post Code is required');
                }
                if(empty($this->halal_cert)){
                    $validator->errors()->add('halal_cert', 'Halal Certificate is required');
                }
                if(empty($this->alchohol_served)){
                    $validator->errors()->add('alchohol_served', 'Alchohol Served is required');
                }
                if(empty($this->male_service)){
                    $validator->errors()->add('male_service', 'Male Service is required');
                }
                if(empty($this->female_service)){
                    $validator->errors()->add('female_service', 'Female Service is required');
                }
                if(empty($this->gender_segregated)){
                    $validator->errors()->add('gender_segregated', 'Gender Segregated is required');
                }
                if(empty($this->family_area)){
                    $validator->errors()->add('family_area', 'Family Area is required');
                }
                if(empty($this->introduction)){
                    $validator->errors()->add('introduction', 'Introduction is required');
                }
                if(empty($this->details)){
                    $validator->errors()->add('details', 'Details is required');
                }
                if(empty($this->smallprint)){
                    $validator->errors()->add('smallprint', 'Smallprint is required');
                }
                if(empty($this->prod_types)){
                    $validator->errors()->add('prod_types[]', 'select atleast one product types.');
                }
            }else{
                if(empty($this->address1_cust)){
                    $validator->errors()->add('address1_cust', 'Address1 is required');
                }
                if(empty($this->town_cust)){
                    $validator->errors()->add('town_cust', 'Town field is required');
                }
                if(empty($this->city_cust)){
                    $validator->errors()->add('city_cust', 'City field is required');
                }
                if(empty($this->post_code_cust)){
                    $validator->errors()->add('post_code_cust', 'Postal code field is required');
                }
                if(empty($this->country)){
                    $validator->errors()->add('country', 'Country field is required');
                }
                if(empty($this->title)){
                    $validator->errors()->add('title', 'Title is required');
                }
                if(empty($this->dob)){
                    $validator->errors()->add('dob', 'DOB is required');
                }
            }
        });
    }

}
