<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use App\Business;
use App\Wallet;

class WithdrawlRequest extends FormRequest {

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
            'amount' => 'required|numeric',
            'bank_name' => 'required',
            'account_holder_name' => 'required',
            'account_number' => 'required|numeric',
            'ifsc_code' => 'required',
            'branch_name' => 'required'
        ];
    }

    public function withValidator($validator) {
        $validator->after(function($validator) {
            $user_id = Auth::guard('frontend')->user()->id;
            $business = Business::where('user_id', $user_id)->first();
            $wallet= Wallet::where('user_id', $user_id)->where('status','0')->sum('amount');
            $balance=($business->wallet_amount)-$wallet;
                if ($this->amount >$balance) {
                    $validator->errors()->add('amount', 'You Dont have  enough withdrawl request');
                } 
            
        });
    }

}
