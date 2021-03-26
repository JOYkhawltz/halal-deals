<?php

namespace Modules\Admin\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CmsRequest extends FormRequest {

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        if ($this->type === '2') {
            return [
                'page_name' => 'required|max:100',
                'content_name' => 'required|max:100',
                'content_body' => 'required|mimes:jpeg,png,jpg|dimensions:min_width=700,min_height=400',
            ];
        } else if ($this->type === '3') {
            return [
                'page_name' => 'required|max:100',
                'content_name' => 'required|max:100',
                'content_body' => 'mimetypes:video/mp4',
            ];
        } else {
            return [
                'page_name' => 'required|max:100',
                'content_name' => 'required|max:100',
                'content_body' => 'required',
            ];
        }
    }

    public function withValidator($validator) {
        $validator->after(function($validator) {
            //
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
