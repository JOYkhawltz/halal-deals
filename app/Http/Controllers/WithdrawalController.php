<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
/* * ***************Requests******************* */
use App\Http\Requests\WithdrawlRequest;
/* * ***************Models******************* */
use App\Business;
use App\User;
use App\Wallet;
use App\Notification;

class WithdrawalController extends Controller
{
    public function index()
    {
        $user_id = Auth()->guard('frontend')->user()->id;
        $business = Business::select('bus_ID','wallet_amount')->where('user_id', $user_id)->first();
        $withdrawls= Wallet::where('user_id',$user_id)->where('status','<>','3')->orderBy('id', 'DESC')->paginate(10);
        return view('withdrawal.withdrawal', compact('business','withdrawls'));
    }
    public function withdrawl_request(WithdrawlRequest $request)
    {
         if ($request->ajax()) {
            $data = [];
            $this->withdrawlrequest_store($request, NULL);
            $notification = [];
            $user_id = Auth::guard('frontend')->user()->id;
            $user= User::where('id', $user_id)->first();
            $notification['notify_view_users'] = 'admin';
            $notification['notifiers_id'] = '';
            $notification['type'] = '9';
            $notification['notify_msg'] = 'Withdrawl Request from vendor '.$user->first_name.''.$user->last_name;
            $notification['status'] = '0';
            Notification::create($notification);
            $data['msg'] = 'Withdrawl request submit Successfully.';
            $data['link'] = route('withdrawal-wallet');
            return response()->json($data);
        }
    }
    private function withdrawlrequest_store($request) {
        $input = $request->input();
        $user_id = Auth()->guard('frontend')->user()->id;
        $business = Business::select('bus_ID')->where('user_id', $user_id)->first();
        if (count($business) > 0) {
            $input['user_id'] = $user_id;
            $input['status'] = '0';
            Wallet::create($input);
        }
    }
    public function withdrawl_history($id)
    {
        $withdrawl= Wallet::where('id',$id)->first();
        return view('withdrawal.view', compact('withdrawl'));
    }
}
