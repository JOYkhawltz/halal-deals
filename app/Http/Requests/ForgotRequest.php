<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\User;

class ForgotRequest extends FormRequest {

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
            'email' => 'required|email',
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            $model = User::where('type_id', '<>', '1')->where('email', '=', $this->email)->where('status', '=', '1')->first();
            if (count($model) === 0)
                $validator->errors()->add('email', 'We could not find the email that you are looking for.');
        });
    }

}
