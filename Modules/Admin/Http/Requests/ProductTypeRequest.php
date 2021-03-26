<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\ProductType;

class ProductTypeRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'name' => 'required|max:100|regex:/^[a-zA-Z\s]+$/'
        ];
    }

    public function withValidator($validator) {
        $validator->after(function($validator) {
            $checkUser = ProductType::where('id', '<>', $this->id)->where('name', $this->name)->first();
            if (count($checkUser) > 0)
                $validator->errors()->add('name', 'Name already in use.');
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
