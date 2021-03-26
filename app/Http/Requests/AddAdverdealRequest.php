<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Setting;

class AddAdverdealRequest extends FormRequest {

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
            'title' => 'required|max:30',
            'prod_ID' => 'required',
//            'date_start' => 'required|date_format:d-m-Y',
//            'date_finish' => 'required|date_format:d-m-Y|after:date_start',
            'deal_start' => 'required|date_format:d-m-Y',
            'deal_end' => 'required|date_format:d-m-Y|after_or_equal:deal_start',
            'smallprint' => 'required',
        ];
    }

    

    public function withValidator($validator) {
        $validator->after(function($validator) {

            if (isset($this->spec_times) && $this->spec_times == 1) {
                if ($this->date_start == "") {
                    $validator->errors()->add('date_start', 'Please give a start Date.');
                } 

            }
            if(!preg_match("/^(https|http):\/\/(?:www\.)?youtube.com\/embed\/[A-z0-9]/", $this->youtube_url))
            {
                $validator->errors()->add('youtube_url', 'Enter a valid url.');
            }
        });
    }

}
