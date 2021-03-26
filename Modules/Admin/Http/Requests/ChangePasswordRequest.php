<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswordRequest extends FormRequest {

    public function __construct() {
        $this->redirect = "admin/myprofile#tab_2";
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'retype_password' => 'required|same:new_password',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function($validator) {
            $admin_user = Auth::guard('backend')->user();
            if (!Hash::check($this->old_password, $admin_user->password))
                $validator->errors()->add('old_password', 'Old password is incorrect.');
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
