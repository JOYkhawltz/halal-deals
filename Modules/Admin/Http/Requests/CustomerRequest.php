<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class CustomerRequest extends FormRequest {

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
        ];
    }

    public function withValidator($validator) {
        $validator->after(function($validator) {
            $checkUser = User::where('id', '<>', $this->id)->where('email', $this->email)->first();
            if (count($checkUser) > 0)
                $validator->errors()->add('email', 'Email already in use.');
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
