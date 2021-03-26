<?php

namespace Modules\Staff\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\User;

class EditProfileRequest extends FormRequest {

    public function __construct() {
        $this->redirect = "staff/myprofile#tab_1";
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
            'image' => 'mimes:jpg,jpeg,png',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function($validator) {
            $other_user = User::where('email', '=', $this->email)->where('id', '<>', Auth::guard('staff')->user()->id)->first();
            if (count($other_user) > 0)
                $validator->errors()->add('email', 'Email id already in use.');
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
