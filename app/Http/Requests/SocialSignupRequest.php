<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Session;
use App\User;

class SocialSignupRequest extends FormRequest {

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
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            if (Session::get('email') === NULL && $this->email === NULL)
                $validator->errors()->add('email', 'Please provide your email for future communication from us.');
            else {
                $email = Session::has('email') ? Session::get('email') : $this->email;
                $checkUser = User::where('email', $email)->first();
                if (count($checkUser) > 0)
                    $validator->errors()->add('email', 'Email already in use.');
            }
        });
    }

}
