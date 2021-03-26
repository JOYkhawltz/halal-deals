<?php

namespace Modules\Staff\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use App\User;

class LockRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'password' => 'required'
        ];
    }

    public function withValidator($validator) {
        $validator->after(function($validator) {
            if ($this->password !== NULL) {
                $model = User::where('type_id', '=', '2')->where('email', '=', $_COOKIE['staff_email_lock'])->first();
                if (!Hash::check($this->password, $model->password))
                    $validator->errors()->add('password', 'Incorrect Password!');
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
