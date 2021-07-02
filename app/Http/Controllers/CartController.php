<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Validator;
use Illuminate\Support\Facades\Auth;
use URL;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
/* * ********* Request **************** */
//use App\Http\Requests\ShippingAddressRequest;
//use App\Http\Requests\PaymentFormRequest;

/* * ********* Models **************** */
use App\Cart;
use App\Advert;
use App\Country;

class CartController extends Controller {

    public function index() {

        $data = [];
        if (Session::has('coupon')) {
            Session::forget('coupon');
        }
        if (Session::has('shipping_price')) {
            Session::forget('shipping_price');
        }
        if (isset(Auth()->guard('frontend')->user()->type_id) && Auth()->guard('frontend')->user()->type_id === "3") {
            abort(404, 'Something went wrong');
        }
        if (Auth()->guard('frontend')->guest() && Cookie::has('guest_user_halaldeals')) {
            $user_id = Cookie::get('guest_user_halaldeals');
        } else if (!Auth()->guard('frontend')->guest()) {
            $user_id = Auth()->guard('frontend')->user()->id;
        } else {
            $user_id = 0;
        }

        $data['carts'] = $cart = Cart::where(['user_id' => $user_id, 'status' => '1'])->get();
        if ($user_id === 0) {
            return view('cart.notfound');
        } else {
            if (!count($data['carts']) > 0) {
                return view('cart.notfound');
            } else {
                return view('cart.cart', $data);
            }
        }
    }
    public function cart_update(Request $request){

        if ($request->ajax()) {
            $data = [];
            $input = [];
            $advert_id = $request->input('advert_id');
            $advert_type = $request->input('advert_type');
            $quantity = $request->input('cart_quantity');
            // if($quantity < 1 && ==){ 
            //     $quantity=1;

            //  }
            $model = Advert::findorFail($advert_id);
            if (Auth()->guard('frontend')->guest()) {
                $user_id = $this->rand_string(10);
                if (Cookie::has('guest_user_halaldeals')) {
                    $user_id = Cookie::get('guest_user_halaldeals');
                } else {
                    Cookie::queue(Cookie::make('guest_user_halaldeals', $user_id, (86400 * 30), '/'));
                }
            } else {
                $user_id = Auth()->guard('frontend')->user()->id;
            }
            $checkProduct = Cart::where('user_id', $user_id)->where('advert_ID', $advert_id)->where('status', '1')->first();
            if ($advert_type == 'deal') {
                if (count($checkProduct) > 0) {
                    //$input['quantity'] = $checkProduct->quantity;
                    $input['quantity'] =  $quantity;
                    $checkProduct->update($input);
                        $products = Cart::where('user_id', $user_id)->where('status', '1')->get();
                        $total = 0;
                        $sub_total = 0;
                        foreach ($products as $product) {
                            $total += (($product->quantity * $product->item_price));
                            $sub_total += ($product->quantity * $product->item_price);
                        }
                        
                        $data['total'] = "£" . number_format($total, 2);
                        $data['sub_total'] = "£" . number_format($sub_total, 2);
                    $data['type'] = 1;
                    $data['cart_count'] = Cart::where('user_id', $user_id)->whereStatus('1')->count();
                    $data['msg'] = "cart updated successfully.";
                    
                } else {
                    $input['user_id'] = $user_id;
                    $input['advert_ID'] = $advert_id;
                    $input['item_price'] = ($model->hd_price !== NULL) ? $model->hd_price : 0;
                    $input['status'] = '1';
                    $input['quantity'] = $quantity;
                    $input['type'] = 'deal';
                    Cart::create($input);
                    $data['type'] = 1;
                    $data['cart_count'] = Cart::where('user_id', $user_id)->whereStatus('1')->count();
                    $data['msg'] = "Successfully added to the cart.";
                }
            } 

            return response()->json($data);
        }
        

       

        
    }

    public function add_to_cart(Request $request) {
        if ($request->ajax()) {
            $data = [];
            $input = [];
            $advert_id = $request->input('advert_id');
            $advert_type = $request->input('advert_type');
            $quantity = 1;
            $model = Advert::findorFail($advert_id);
            if (Auth()->guard('frontend')->guest()) {
                $user_id = $this->rand_string(10);
                if (Cookie::has('guest_user_halaldeals')) {
                    $user_id = Cookie::get('guest_user_halaldeals');
                } else {
                    Cookie::queue(Cookie::make('guest_user_halaldeals', $user_id, (86400 * 30), '/'));
                }
            } else {
                $user_id = Auth()->guard('frontend')->user()->id;
            }
            $checkProduct = Cart::where('user_id', $user_id)->where('advert_ID', $advert_id)->where('status', '1')->first();
            if ($advert_type == 'deal') {
                if (count($checkProduct) > 0) {
                    $input['quantity'] = $checkProduct->quantity + 1;
                    $checkProduct->update($input);
                    $data['type'] = 1;
                    $data['cart_count'] = Cart::where('user_id', $user_id)->whereStatus('1')->count();
                    $data['msg'] = "cart quantity updated successfully.";
                    
                } else {
                    $input['user_id'] = $user_id;
                    $input['advert_ID'] = $advert_id;
                    $input['item_price'] = ($model->hd_price !== NULL) ? $model->hd_price : 0;
                    $input['status'] = '1';
                    $input['quantity'] = $quantity;
                    $input['type'] = 'deal';
                    Cart::create($input);
                    $data['type'] = 1;
                    $data['cart_count'] = Cart::where('user_id', $user_id)->whereStatus('1')->count();
                    $data['msg'] = "Successfully added to the cart.";
                }
            } 

            return response()->json($data);
        }
    }

    public function remove_from_cart(Request $request) {
        if ($request->ajax()) {
            $data = [];
            $input = [];
            if (Auth()->guard('frontend')->guest() && Cookie::has('guest_user_halaldeals')) {
                $user_id = Cookie::get('guest_user_halaldeals');
            } else {
                $user_id = Auth()->guard('frontend')->user()->id;
            }
            $advert_id = $request->input('advert_id');
            $checkProduct = Cart::where('user_id', $user_id)->where('advert_ID', $advert_id)->where('status', '1')->first();
            if (count($checkProduct) > 0) {
                $input['status'] = '3';
                $checkProduct->update($input);
                $products = Cart::where('user_id', $user_id)->where('status', '1')->get();
                $total = 0;
                $sub_total = 0;
                foreach ($products as $product) {
                    $total += (($product->quantity * $product->item_price));
                    $sub_total += ($product->quantity * $product->item_price);
                }
                $data['cart_count'] = count($products);
                if (count($products) === 0) {
                    $data['content'] = view('cart.notfound')->render();
                }
                $data['total'] = "£" . number_format($total, 2);
                $data['sub_total'] = "£" . number_format($sub_total, 2);
                $data['msg'] = "Successfully removed from cart.";
                $data['type'] = 1;
            } else {
                $data['type'] = 2;
                $data['msg'] = "Oops!something went wrong.";
            }
            return response()->json($data);
        }
    }

    public function checkout() {
        $data = [];
        $user_id = Auth()->guard('frontend')->user()->id;
        $carts = Cart::where(['user_id' => $user_id, 'type' => 'voucher', 'status' => '1'])->get();
        if (count($carts) > 0) {
            foreach ($carts as $cart) {
                $advert = Advert::where('advert_ID',$cart->advert_ID)->where('advert_type','voucher')->where('status','1')->first();
                
                    if (($cart->quantity) > $advert->total_voucher) {
                        return redirect()->back()->with('error', 'Now voucher '.$advert->title.' out of stock ');
                        exit();
                    }
            }
        }
//        $data['count_postage']=Cart::with('postage')->where(['user_id' => $user_id, 'status' => '1'])->get();
        $data['postage']=DB::table('carts')
                ->join('adverts', 'adverts.advert_ID', '=', 'carts.advert_ID')
                ->select('carts.*')
                ->where('carts.user_id', '=', $user_id) 
                ->where('carts.status', '=', "1")
                ->where('adverts.postage', '=', "1")
                ->count();
        $data['cart_products'] = $cart = Cart::where(['user_id' => $user_id, 'status' => '1'])->get();
        $data['country'] = Country::where('status', '1')->orderBy("name")->get();
//        print_r($data['postage']);exit;
        return view('cart.checkout', $data);
    }

}