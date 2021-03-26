<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PaymentRequest;
use App\Http\Requests\CardRequest;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use App\Services\Payments;
use App\OrderMaster;
use App\Cart;
use App\OrderDetails;
use App\Advert;
use App\Business;
use App\User;
use App\VoucherDetail;
use App\Notification;
use PayPal\Api\Payment;


class PaymentController extends Controller {

    public function payment_checkout(PaymentRequest $request) {
        $data_msg = [];
        $data_msg['status'] = 'success';
        return response()->json($data_msg);
    }

    public function card_checkout(CardRequest $request, Payments $payment) {
        $data = [];
        $user_id = Auth()->guard('frontend')->user()->id;
        $store_card = $payment->post_payment($request);
        if (isset($store_card['status']) && $store_card['status'] == 200) {
            
            $payment_store = $this->store_payment_details($store_card, $user_id, $request);
            if ($payment_store->status === 'completed') {
                $data['msg'] = 'You successfully purchase This product.';
                $data['link'] = route('/');
                $data['status'] = 200;
            } else {
                $data['status'] = 400;
                $data['msg'] = 'Your payment is failed.';
            }
        } else {
            $data['msg'] = $store_card['msg'];
            $data['status'] = 400;
        }
        return response()->json($data);
    }

    public function store_payment_details_express_checkout($resp, $user_id, $request) {
        $input = $resp;
        $details = $resp['details'];
        $user = User::findOrFail($user_id);
        // $method = $request->input('payment_gateway');
        $input['payment_gateway'] = 'paypal';
        $input['user_id'] = $user_id;

        $amount = number_format($details->transactions[0]->amount->total, 2);
        $input['total_amount'] = $amount;
        $input['currency'] = $details->transactions[0]->amount->currency;
        $relatedResources = $details->transactions[0]->getRelatedResources();
        $sale = $relatedResources[0]->getSale();
        $input['txn_id'] = ($sale->getId() !== NULL) ? $sale->getId() : NULL;

        $input['pay_amount'] = $amount;
        $input['chrage_id'] = $details->id;
        $input['ip_address'] = request()->ip();
        if (isset($details->status) && $details->status == 'succeeded') {
            $input['status'] = 'completed';
            $flag = 1;
        } else if (isset($details->state) && $details->state == 'approved') {
            $input['status'] = 'completed';
            $flag = 1;
        } else {
            $input['status'] = 'decline';
            $flag = 0;
        }
        $postage=DB::table('carts')
                ->join('adverts', 'adverts.advert_ID', '=', 'carts.advert_ID')
                ->select('carts.*')
                ->where('carts.user_id', '=', $user_id) 
                ->where('carts.status', '=', "1")
                ->where('adverts.postage', '=', "1")
                ->count();
        if($postage=="1")
        {
            $input['name'] = $request['name'];
            $input['phone'] = $request['phone'];
            $input['address'] = $request['address'];
            $input['city'] = $request['city'];
            $input['country'] = $request['country'];
            $input['zipcode'] = $request['zipcode'];
        }else{
            $input['name'] = $user->first_name." ".$user->last_name;
            $input['phone'] = $user->phone;
        }
        $last_order_id = OrderMaster::orderBy('id', 'desc')->first();
        if (empty($last_order_id)) {
            $order_number = $this->rand_string(8) . '0';
        } else {
            $order_number = $this->rand_string(8) . $last_order_id->id;
        }
        $input['order_number'] = $order_number;
        $payment = OrderMaster::create($input);
        $cart = Cart::where('user_id', $user_id)->where('status', '1')->get();
        foreach ($cart as $key => $value) {
            $order['user_id'] = $user_id;
            $order['order_id'] = $payment->id;
            $order['advert_id'] = $value->advert_ID;
            $advert_details = Advert::where('advert_id', $value->advert_ID)->first();
            $order['bus_ID'] = $advert_details->bus_ID;
            $order['quantity'] = $value->quantity;
            $order['type'] = $value->type;
            $order['item_price'] = $value->item_price;
            $order['status'] = '0';
            $orders = OrderDetails::create($order);
        }

        if ($flag == 1) {

            $cart = Cart::where('user_id', $user_id)->where('status', '1')->get();
            foreach ($cart as $key => $value) {
                $voucher = [];

                $advert = Advert::findOrFail($value->advert_ID);
                $business = Business::findOrFail($advert->bus_ID);
                for ($i = 1; $i <= $value->quantity; $i++) {
                    $voucher['order_id'] = $payment->id;
                    $voucher['advert_ID'] = $value->advert_ID;
                    $voucher['voucher_ID'] = $this->rand_string(12);
                    $voucher['bus_ID'] = $business->bus_ID;
                    $voucher['redeem'] = '2';
                    $voucher['status'] = '1';
                    $voucher['purchasing_user'] = $user_id;
                    VoucherDetail::create($voucher);
                }
                $wallet_amount = $business->wallet_amount;
                if ($advert->advert_type == "deal") {
                    $additional_amount = $advert->cost_price;
                }
                $total_amount = ($value->quantity * $additional_amount);
                $business->wallet_amount = $total_amount + $wallet_amount;
                $business->save();

                $model = Cart::findOrFail($value->id);
                $model->status = '3';
                $model->save();
            }

            $get_business = OrderDetails::where('order_id', $payment->id)->groupBy('bus_ID')->pluck('bus_ID')->all();
            foreach ($get_business as $bus) {
                $user_business = User::select('users.*')
                                ->leftjoin('businesses', 'businesses.user_id', 'users.id')->where('businesses.bus_ID', $bus)->first();
                $email_data2 = [
                    'to' => $user_business->email,
                    'subject' => "Item purchase",
                    'template' => 'purchase_template2',
                    'data' => $payment->id,
                    'bus_ID' => $bus
                ];

//                $this->SendMail2_to_business($email_data2);

                $notification = [];
                $notification['notify_view_users'] = 'business';
                $notification['notifiers_id'] = $user_business->id;
                $notification['type'] = '3';
                $notification['notify_msg'] = 'Order Successfully Purchase By ' . $user->first_name . ' ' . $user->last_name;
                $notification['status'] = '0';
                Notification::create($notification);
            }

            $email_data = [
                'to' => $user->email,
                'subject' => "Item purchase",
                'template' => 'purchase_template',
                'data' => $payment->id
            ];
            $this->SendMail2_to_customer($email_data);

            $notification2 = [];
            $notification2['notify_view_users'] = 'admin';
            $notification2['notifiers_id'] = '';
            $notification2['type'] = '3';
            $notification2['notify_msg'] = 'Order Successfully Purchase By ' . $user->first_name . ' ' . $user->last_name;
            $notification2['status'] = '0';
            Notification::create($notification2);
            $notification3 = [];
            $notification3['notify_view_users'] = 'user';
            $notification3['notifiers_id'] = $user_id;
            $notification3['type'] = '3';
            $notification3['notify_msg'] = 'Order successfully Purchase';
            $notification3['status'] = '0';
            Notification::create($notification3);
        }
        return $payment;
    }

        public function store_payment_details($resp, $user_id, $request) {
        $input = $resp;
        $details = $resp['details'];
        $user = User::findOrFail($user_id);
        $method = $request->input('payment_gateway');
        $input['payment_gateway'] = 'paypal';
        $input['user_id'] = $user_id;

        $amount = number_format($details->transactions[0]->amount->total, 2);
        $input['total_amount'] = $amount;
        $input['currency'] = $details->transactions[0]->amount->currency;
        $relatedResources = $details->transactions[0]->getRelatedResources();
        $sale = $relatedResources[0]->getSale();
        $input['txn_id'] = ($sale->getId() !== NULL) ? $sale->getId() : NULL;

        $input['pay_amount'] = $amount;
        $input['chrage_id'] = $details->id;
        $input['ip_address'] = request()->ip();
        if (isset($details->status) && $details->status == 'succeeded') {
            $input['status'] = 'completed';
            $flag = 1;
        } else if (isset($details->state) && $details->state == 'approved') {
            $input['status'] = 'completed';
            $flag = 1;
        } else {
            $input['status'] = 'decline';
            $flag = 0;
        }
        $postage=DB::table('carts')
                ->join('adverts', 'adverts.advert_ID', '=', 'carts.advert_ID')
                ->select('carts.*')
                ->where('carts.user_id', '=', $user_id) 
                ->where('carts.status', '=', "1")
                ->where('adverts.postage', '=', "1")
                ->count();
        if($postage=="1")
        {
            $input['name'] = $request->input('name');
            $input['phone'] = $request->input('phone');
            $input['address'] = $request->input('address');
            $input['city'] = $request->input('city');
            $input['country'] = $request->input('country');
            $input['zipcode'] = $request->input('zipcode');
        }else{
            $input['name'] = $user->first_name." ".$user->last_name;
            $input['phone'] = $user->phone;
        }
        $last_order_id = OrderMaster::orderBy('id', 'desc')->first();
        if (empty($last_order_id)) {
            $order_number = $this->rand_string(8) . '0';
        } else {
            $order_number = $this->rand_string(8) . $last_order_id->id;
        }
        $input['order_number'] = $order_number;
        $payment = OrderMaster::create($input);
        $cart = Cart::where('user_id', $user_id)->where('status', '1')->get();
        foreach ($cart as $key => $value) {
            $order['user_id'] = $user_id;
            $order['order_id'] = $payment->id;
            $order['advert_id'] = $value->advert_ID;
            $advert_details = Advert::where('advert_id', $value->advert_ID)->first();
            $order['bus_ID'] = $advert_details->bus_ID;
            $order['quantity'] = $value->quantity;
            $order['type'] = $value->type;
            $order['item_price'] = $value->item_price;
            $order['status'] = '0';
            $orders = OrderDetails::create($order);
        }

        if ($flag == 1) {

            $cart = Cart::where('user_id', $user_id)->where('status', '1')->get();
            foreach ($cart as $key => $value) {
                $voucher = [];

                $advert = Advert::findOrFail($value->advert_ID);
                $business = Business::findOrFail($advert->bus_ID);
                for ($i = 1; $i <= $value->quantity; $i++) {
                    $voucher['order_id'] = $payment->id;
                    $voucher['advert_ID'] = $value->advert_ID;
                    $voucher['voucher_ID'] = $this->rand_string(12);
                    $voucher['bus_ID'] = $business->bus_ID;
                    $voucher['redeem'] = '2';
                    $voucher['status'] = '1';
                    $voucher['purchasing_user'] = $user_id;
                    VoucherDetail::create($voucher);
                }
                $wallet_amount = $business->wallet_amount;
                if ($advert->advert_type == "deal") {
                    $additional_amount = $advert->cost_price;
                }
                $total_amount = ($value->quantity * $additional_amount);
                $business->wallet_amount = $total_amount + $wallet_amount;
                $business->save();

                $model = Cart::findOrFail($value->id);
                $model->status = '3';
                $model->save();
            }

            $get_business = OrderDetails::where('order_id', $payment->id)->groupBy('bus_ID')->pluck('bus_ID')->all();
            foreach ($get_business as $bus) {
                $user_business = User::select('users.*')
                                ->leftjoin('businesses', 'businesses.user_id', 'users.id')->where('businesses.bus_ID', $bus)->first();
                $email_data2 = [
                    'to' => $user_business->email,
                    'subject' => "Item purchase",
                    'template' => 'purchase_template2',
                    'data' => $payment->id,
                    'bus_ID' => $bus
                ];

//                $this->SendMail2_to_business($email_data2);

                $notification = [];
                $notification['notify_view_users'] = 'business';
                $notification['notifiers_id'] = $user_business->id;
                $notification['type'] = '3';
                $notification['notify_msg'] = 'Order Successfully Purchase By ' . $user->first_name . ' ' . $user->last_name;
                $notification['status'] = '0';
                Notification::create($notification);
            }

            $email_data = [
                'to' => $user->email,
                'subject' => "Item purchase",
                'template' => 'purchase_template',
                'data' => $payment->id
            ];
            $this->SendMail2_to_customer($email_data);

            $notification2 = [];
            $notification2['notify_view_users'] = 'admin';
            $notification2['notifiers_id'] = '';
            $notification2['type'] = '3';
            $notification2['notify_msg'] = 'Order Successfully Purchase By ' . $user->first_name . ' ' . $user->last_name;
            $notification2['status'] = '0';
            Notification::create($notification2);
            $notification3 = [];
            $notification3['notify_view_users'] = 'user';
            $notification3['notifiers_id'] = $user_id;
            $notification3['type'] = '3';
            $notification3['notify_msg'] = 'Order successfully Purchase';
            $notification3['status'] = '0';
            Notification::create($notification3);
        }
        return $payment;
    }

    public function paypal_checkout(Request $request,Payments $payment) {
        $data = [];
        $user_id = Auth()->guard('frontend')->user()->id;
        // print_r($request);
        // exit();
        $store_card = $payment->post_express_payment($request);
        return response()->json($store_card);
    }

    public function express_checkout_success(Request $request,Payments $payment){
        $user_id = Auth()->guard('frontend')->user()->id;
        // if(isset($_GET['paymentId'])){
        // $payment->
        // print_r($_GET['paymentId']);
        $payment_id = $_GET['paymentId'];
        // exit();
        // echo "</br>";
        $resp = $payment->get_payment_details($_GET['paymentId']);
        // echo "<pre>";
        // print_r($payment_details);
        // echo "</pre>";
        $input = $request->input();
        if(Session::has('name')){
            $input['name'] = $name = Session::get('name');
            Session::forget('name');
        }
        if(Session::has('phone')){
            $input['phone'] = $name = Session::get('phone');
            Session::forget('phone');
        }
        if(Session::has('address')){
            $input['address'] = $name = Session::get('address');
            Session::forget('address');
        }
        if(Session::has('city')){
            $input['city'] = $name = Session::get('city');
            Session::forget('city');
        }
        if(Session::has('country')){
            $input['country'] = $name = Session::get('country');
            Session::forget('country');
        }
        if(Session::has('zipcode')){
            $input['zipcode'] = $name = Session::get('zipcode');
            Session::forget('zipcode');
        }
        // echo "<pre>";
        // // print_r($input);
        // echo Session::get('name');
        // echo "</pre>";
        // exit();
        $payment_store = $this->store_payment_details_express_checkout($resp, $user_id, $input);
        // print_r($payment_store);
        // exit();
            if ($payment_store->status === 'completed') {
                // Session::put('success','Payment Completed');
                // return redirect()->route('/');
                return redirect()->route('/')->with('success','Payment Completed');
            } else {
                // Session::put('error','Something Went Wrong!');
                // return redirect()->route('/');
                return redirect()->route('/')->with('error','Something Went Wrong!');
            }
    }

    public function express_checkout_fails(){
        // Session::put('error','Payment Failed');
        return redirect()->route('/')->with('error','Payment Failed');    
    }

}
