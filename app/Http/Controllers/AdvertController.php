<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
//use Intervention\Image\ImageManagerStatic as Image;
use Yajra\DataTables\Facades\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
/* * ***************Requests******************* */
use App\Http\Requests\AddAdverdealRequest;
use App\Http\Requests\AddAdvervoucherRequest;
use App\Http\Requests\EditAdvertRequest;
/* * ***************Models******************* */
use App\Advert;
use App\User;
use App\Product;
use App\Business;
use App\Setting;
use App\Notification;
use App\VoucherDetail;

class AdvertController extends Controller {

    public function get_advert_deal_list() {
        if (Auth()->guard('frontend')->user()->type_id === '3') {
            $bus_id = Business::select('bus_ID')->where('user_id', Auth()->guard('frontend')->user()->id)->first();
            $adverts = Advert::where('bus_ID', $bus_id->bus_ID)->where('advert_type', '=', 'deal')->where('status', '<>', '3')->paginate(10);
            return view('advert.deallisting', compact('adverts'));
        } else {
            abort(404);
        }
    }

    public function get_advert_voucher_list(Request $request) {
        if ($request->ajax()) {
            $bus_id = Business::select('bus_ID')->where('user_id', Auth()->guard('frontend')->user()->id)->first();
            $voucher_list = VoucherDetail::select('*')
                            ->where('status', '1')->where('redeem','2')->where('bus_ID',$bus_id->bus_ID);
            return DataTables::of($voucher_list)
                            
                            ->editColumn('voucher_ID', function ($model) {
                                return $model->voucher_ID;
                            })
                            ->editColumn('advert_ID', function ($model) {
                                $adverts = Advert::where('advert_ID', $model->advert_ID)->where('advert_type', '=', 'deal')->first();
                                return $adverts->hd_price;
                                return (!empty($model->date)) ? \Carbon\Carbon::parse($model->date)->format('Y-m-d') : 'Not Found';
                            })
                            ->editColumn('purchasing_user', function ($model) {
                                $user=User::where('id','=',$model->purchasing_user)->first();
                                return $user->first_name.' '.$user->last_name;
                            })
                            ->editColumn('created_at', function ($model) {
                                return (!empty($model->created_at)) ? \Carbon\Carbon::parse($model->created_at)->format('Y-m-d') : 'Not Found';
                            })
                            ->editColumn('status', function ($model) {
                            if ($model->status == '0') {
                                    $status = '<span class="pending-status"><i class="icofont-warning"></i>Pending</span>';
                                } else if ($model->status == '1') {
                                    $status = '<span class="cnf-status"><i class="icofont-check"></i>Confirmed</span>';
                                } else if ($model->status == '3') {
                                    $status = '<span class="cancel-status"><i class="icofont-close"></i>Cancel</span>';
                                }
                                return $status;
                            })
                            ->addColumn('action', function ($model) {
                                return
                                '<a href="' . Route("advert-voucheredit-details", [$model->id]) . '" class="edit"><i class="icofont-ui-edit"></i> Edit</a>' ;
                            })
                            
                            ->rawColumns(['status','action'])
                            ->make(true);
        }
        if (Auth()->guard('frontend')->user()->type_id === '3') {
            
            return view('advert.voucherlisting');
        } else {
            abort(404);
        }
    }
    public function get_redeem_list(Request $request) {
        if ($request->ajax()) {
            $bus_id = Business::select('bus_ID')->where('user_id', Auth()->guard('frontend')->user()->id)->first();
            $voucher_list = VoucherDetail::select('*')
                            ->where('status', '1')->where('bus_ID',$bus_id->bus_ID);
            return DataTables::of($voucher_list)
                            
                            ->editColumn('voucher_ID', function ($model) {
                                return $model->voucher_ID;
                            })
                            ->editColumn('advert_ID', function ($model) {
                                $adverts = Advert::where('advert_ID', $model->advert_ID)->where('advert_type', '=', 'deal')->first();
                                return $adverts->hd_price;
                                return (!empty($model->date)) ? \Carbon\Carbon::parse($model->date)->format('Y-m-d') : 'Not Found';
                            })
                            ->editColumn('purchasing_user', function ($model) {
                                $user=User::where('id','=',$model->purchasing_user)->first();
                                return $user->first_name.' '.$user->last_name;
                            })
                            ->editColumn('created_at', function ($model) {
                                return (!empty($model->created_at)) ? \Carbon\Carbon::parse($model->created_at)->format('Y-m-d') : 'Not Found';
                            })
                            ->editColumn('status', function ($model) {
                            if ($model->redeem == '1') {
                                    $status = '<span class="pending-status"><i class="icofont-check"></i>Redeemed</span>';
                                } else if ($model->redeem == '2') {
                                    $status = '<span class="cnf-status"><i class="icofont-warning"></i>Not Redeemed</span>';
                                }
                                return $status;
                            })
                            ->addColumn('action', function ($model) {
                                if ($model->redeem == '1') {
                                    $redeem = '<p class="edit">Already Redeemed</p>' ;
                                } else if ($model->redeem == '2') {
                                    // $redeem = '<a href="' . Route("advert-voucheredit-details", [$model->id]) . '" class="edit"><i class="icofont-ui-edit"></i> Redeem it</a>' ;
                                  $redeem ='<a href="javascript:void(0);" name="redeem" class="edit redeem-voucher" data-id="'. $model->voucher_ID. '"><i class="icofont-coins"></i> Redeem</a>';
                                }
                                return $redeem;
                                // return
                                // '<a href="' . Route("advert-voucheredit-details", [$model->id]) . '" class="edit"><i class="icofont-ui-edit"></i> Redeem</a>' ;
                            })
                            
                            ->rawColumns(['status','action'])
                            ->make(true);
        }
        if (Auth()->guard('frontend')->user()->type_id === '3') {
            
            return view('advert.redeem');
        } else {
            abort(404);
        }
    }








public function voucher_details($id) {
        if (Auth()->guard('frontend')->user()->type_id === '3') {
            $vouchers=VoucherDetail::where('advert_ID',$id)->whereNotNull('purchasing_user')->paginate(10);
            
            return view('advert.voucherdetails', compact('vouchers','id'));
        } else {
            abort(404);
        }
    }
    public function search_voucher(Request $request)
    {
        $search=$request->input('search_data');
        $advert_id=$request->input("advert_id");
        if (Auth()->guard('frontend')->user()->type_id === '3') {
            $vouchers=VoucherDetail::where('advert_ID',$advert_id)->where('voucher_ID', 'LIKE', "%$search%")->whereNotNull('purchasing_user')->paginate(10);
            // print_r($vouchers);die();
            $data['content']=view('advert.voucherdetails_table', compact('vouchers'))->render();
            return response()->json($data);
        }
    }
    public function voucheredit_details($id) {

        if (Auth()->guard('frontend')->user()->type_id === '3') {
            $model=VoucherDetail::where('id',$id)->first();
            $user=User::where('id','=',$model->purchasing_user)->first();
            return view('advert.vouchereditdetails', compact('model','user'));
        } else {
            abort(404);
        }
    }
        public function post_voucheredit_details(Request $request,$id) {

        if (Auth()->guard('frontend')->user()->type_id === '3') {
            $voucher=VoucherDetail::where('id',$id)->first();

            $input['redeem'] = $request->input('redeem');
            $voucher->update($input);
            return \Redirect::Route('get-advert-voucher-list',['id'=>($voucher->advert_ID)])->with('success', 'Redeem Status change successfully ');
        } else {
            abort(404);
        }
    }
    public function get_add_advert_deal() {
        $user = User::findorFail(Auth()->guard('frontend')->user()->id);
        if (Auth()->guard('frontend')->user()->type_id === '3' && isset($user->business->bus_ID) && $user->business->bus_ID != "") {
            $products = Product::select('prod_ID', 'name', 'normal_price','discount_price','commission_type')->where('bus_ID', $user->business->bus_ID)->where('status', '1')->where('price_verified','1')->where('price_verified_date','<>',NULL)->get();
            if (count($products) > 0) {
                return view('advert.dealadd', compact('products'));
            } else {
                return redirect()->route('get-product-list')->with('error', 'Please wait untill your product gets verified.');
            }
        } else {
            return redirect()->route('dashboard')->with('error', 'Opps! something went wrong.');
        }
    }

    public function get_add_advert_voucher() {
        $user = User::findorFail(Auth()->guard('frontend')->user()->id);
        if (Auth()->guard('frontend')->user()->type_id === '3' && isset($user->business->bus_ID) && $user->business->bus_ID != "") {
            return view('advert.voucheradd');
        } else {
            return redirect()->route('dashboard')->with('error', 'Opps! something went wrong.');
        }
    }

    public function get_price(Request $request) {
        if ($request->ajax()) {
            $data = [];

            $product = Product::select('*')->where('prod_ID', $request->input('id'))->first();
            
            if (count($product) > 0) {
                $cost_price = $this->get_cost_price((($product->discount_price == NULL) ? $product->normal_price : $product->discount_price), $product->commission_rate, $product->additional_rate);
                $hd_price = $this->get_HD_price((($product->discount_price == NULL) ? $product->normal_price : $product->discount_price), $cost_price);
            } else {
                $cost_price = $request->input('price');
                $hd_price = $this->get_HD_price($cost_price, $cost_price);
            }

            $data['cost_price'] = number_format($cost_price, 2);
            $data['hd_price'] = number_format($hd_price, 2);
            $data['commission_type'] = $product->commission_type;
            return response()->json($data);
        }
    }

//    public function get_price(Request $request) {
//        if ($request->ajax()) {
//            $data = [];
//                $product = Product::select('normal_price')->where('prod_ID', $request->input('prod_ID'))->first();
//                if (count($product) > 0) {
//                    $cost_price = $this->get_cost_price($product->normal_price, $request->input('coupen_discount'), $request->input('additional_discount'));
//                    $hd_price = $this->get_HD_price($product->normal_price, $cost_price);
//                } else {
//                    $cost_price = $request->input('price');
//                    $hd_price = $this->get_HD_price($product->normal_price, $cost_price);
//                }
//                if ($cost_price <= 0) {
//                    $data['cost_price_error'] = "error";
//                } else {
//                    $data['cost_price'] = number_format($cost_price, 2);
//                    $data['hd_price'] = number_format($hd_price, 2);
//                }
//            return response()->json($data);
//        }
//    }
//    public function additonal_discount(Request $request) {
//        if ($request->ajax()) {
//            $data = [];
//
//            $data['status'] = "success";
//            if (isset($request->additional_discount)) {
//                if (!(is_numeric($request->additional_discount))) {
//                    $data['error'] = 'this is not a number';
//                    $data['status'] = "error";
//                } elseif (($request->prod_ID) == '') {
//                    $data['error'] = 'Please select at least one product.';
//                    $data['status'] = "error";
//                }
//            }
//            if ($data['status'] == "success") {
//
//                $product = Product::select('normal_price')->where('prod_ID', $request->input('prod_ID'))->first();
//                if (count($product) > 0) {
//                    $cost_price = $this->get_cost_price($product->normal_price, $request->input('coupen_discount'), $request->input('additional_discount'));
//                    $hd_price = $this->get_HD_price($product->normal_price, $cost_price);
//                } else {
//                    $cost_price = $request->input('price');
//                    $hd_price = $this->get_HD_price($product->normal_price, $cost_price);
//                }
//                if ($cost_price <= 0) {
//                    $data['cost_price_error'] = "error";
//                } else {
//                    $data['cost_price'] = number_format($cost_price, 2);
//                    $data['hd_price'] = number_format($hd_price, 2);
//                }
//            }
//            return response()->json($data);
//        }
//    }

    public function post_add_advert_voucher(AddAdvervoucherRequest $request) {
        if ($request->ajax()) {
            $data = [];
            $this->voucher_store($request);
            $notification = [];
            $user_id = Auth::guard('frontend')->user()->id;
            $business = Business::where('user_id', $user_id)->first();
//            $notification['from_id'] = $user_id;
            $notification['notify_view_users'] = 'business';
            $notification['notifiers_id'] = $user_id;
            $notification['type'] = '8';
            $notification['notify_msg'] = 'voucher added successfully ';
            $notification['status'] = '0';
            Notification::create($notification);
            $notification['notify_view_users'] = 'admin';
            $notification['notifiers_id'] = '';
            $notification['type'] = '8';
            $notification['notify_msg'] = 'voucher added successfully ';
            $notification['status'] = '0';
            Notification::create($notification);
            $notification['notify_view_users'] = 'staff';
            $notification['notifiers_id'] = $business->hd_staff_link;
            $notification['type'] = '8';
            $notification['notify_msg'] = 'voucher added successfully ';
            $notification['status'] = '0';
            Notification::create($notification);
            $data['msg'] = 'voucher created successfuly.';
            $data['link'] = route('get-advert-voucher-list');
            return response()->json($data);
        }
    }

    public function post_add_advert_deal(AddAdverdealRequest $request) {
        if ($request->ajax()) {
            $data = [];
            $this->deal_store($request, NULL);
            $notification = [];
            $user_id = Auth::guard('frontend')->user()->id;
            $business = Business::where('user_id', $user_id)->first();
//            $notification['from_id'] = $user_id;
            $notification['notify_view_users'] = 'business';
            $notification['notifiers_id'] = $user_id;
            $notification['type'] = '7';
            $notification['notify_msg'] = 'Deal added successfully ';
            $notification['status'] = '0';
            Notification::create($notification);
            $notification['notify_view_users'] = 'admin';
            $notification['notifiers_id'] = '';
            $notification['type'] = '7';
            $notification['notify_msg'] = 'Deal added successfully ';
            $notification['status'] = '0';
            Notification::create($notification);
            $notification['notify_view_users'] = 'staff';
            $notification['notifiers_id'] = $business->hd_staff_link;
            $notification['type'] = '7';
            $notification['notify_msg'] = 'Deal added successfully ';
            $notification['status'] = '0';
            Notification::create($notification);
            $data['msg'] = 'Deal created successfuly.';
            $data['link'] = route('get-advert-deal-list');
            return response()->json($data);
        }
    }

   public function get_edit_advert($id) {
       if (Auth()->guard('frontend')->user()->type_id === '3') {
           $user = User::findorFail(Auth()->guard('frontend')->user()->id);
           $products = Product::select('prod_ID', 'name', 'normal_price')->where('bus_ID', $user->business->bus_ID)->where('status', '1')->get();
           $model = Advert::findorFail(base64_decode($id));
           return view('advert.edit', compact('model', 'products'));
       } else {
           abort(404);
       }
   }

   public function post_edit_advert(EditAdvertRequest $request) {
    
       if ($request->ajax()) {
           $data = [];
//           $this->store($request, $request->input('id'));
           $this->store($request, NULL);
           $notification = [];
           $user_id = Auth::guard('frontend')->user()->id;
           $business = Business::where('user_id',$user_id )->first();
//            $notification['from_id'] = $user_id;
           $notification['notify_view_users'] = 'business';
           $notification['notifiers_id'] = $user_id;
           $notification['type'] = '7';
           $notification['notify_msg'] = ' Advert  updated successfully ';
           $notification['status'] = '0';
           Notification::create($notification);
           $notification['notify_view_users'] = 'admin';
           $notification['notifiers_id'] = '';
           $notification['type'] = '7';
           $notification['notify_msg'] = 'Advert updated successfully ';
           $notification['status'] = '0';
           Notification::create($notification);
           $notification['notify_view_users'] = 'staff';
           $notification['notifiers_id'] = $business->hd_staff_link;
           $notification['type'] = '7';
           $notification['notify_msg'] = 'Advert updated successfully ';
           $notification['status'] = '0';
           Notification::create($notification);
           $data['msg'] = 'Advert updated successfuly.';
           $data['link'] = route('get-advert-deal-list');
           return response()->json($data);
       }
   }
   

    public function delete_advert(Request $request) {
        if ($request->ajax()) {
            $data = [];
            $avert_id = $request->input('id');
            $checkAdvert = Advert::findorFail($avert_id);
            if (count($checkAdvert) > 0) {
                if ($checkAdvert->advert_type == 'deal') {
                    $checkAdvert->update(['status' => '3']);
                    $data['status'] = 200;
                    $data['msg'] = 'Deal Deleted successfully.';
                    $data['link'] = route('get-advert-deal-list');
                } else {
                    $checkAdvert->update(['status' => '3']);
                    $data['status'] = 200;
                    $data['msg'] = 'Voucher Deleted successfully.';
                    
                }
            } else {
                $data['msg'] = 'Opps! something went wrong.';
            }
            return response()->json($data);
        }
    }

    public function redeem_voucher(Request $request) {
        if ($request->ajax()) {
            $data = [];
            $voucher_id = $request->input('id');
            $checkVoucher = VoucherDetail::where('voucher_ID', $voucher_id)->first();
            if (count($checkVoucher) > 0) {
                if ($checkVoucher->status == 1) {
                    $input['redeem'] = 1;
                    $checkVoucher->update($input);
                    $data['status'] = 200;
                    $data['msg'] = 'Voucher Redeemed successfully.';
                    $data['link'] = route('get-redeem-list');
                } else {
                    // $checkVoucher->update(['redeem' => '1']);
                    // $data['status'] = 200;
                    // $data['msg'] = 'Voucher Redeemed successfully.';
                    // $data['link'] = route('get-redeem-list');
                    $checkAdvert->update(['status' => '3']);
                    $data['status'] = 200;
                    $data['msg'] = 'Voucher Deleted successfully.';
                    
                }
            } else {
                $data['msg'] = 'Opps! something went wrong.';
            }
            return response()->json($data);
        }
    }


    public function store($request){
        $id = $request->input('id');
        $input = $request->input();
        $user_id = Auth()->guard('frontend')->user()->id;
        $business = Business::select('bus_ID')->where('user_id', $user_id)->first();
        $product = Product::select('*')->where('prod_ID', $request->input('prod_ID'))->first();
        Advert::where('advert_ID', $id)->where('prod_ID', $product->prod_ID)->where('bus_ID', $business->bus_ID)->first()->update($input); 
       }
       
    private function deal_store($request) {
        $input = $request->input();
        // print_r($input);
        // exit();
        $yt = $request->input("youtube_url");
        $input['youtube_url'] = str_replace("watch?v=","embed/", $yt);
        $postage=$request->input("postage_allow");
        $hot_offer=$request->input("hot_offer");
        if(isset($postage)){
            $input['postage']='1';
        }else{
            $input['postage']="2";
        }
        if(isset($hot_offer)){
            $input['hotoffer']='1';
        }else{
            $input['hotoffer']='2';
        }
        $user_id = Auth()->guard('frontend')->user()->id;
        $business = Business::select('bus_ID')->where('user_id', $user_id)->first();
        $product = Product::select('*')->where('prod_ID', $request->input('prod_ID'))->first();
        if (count($business) > 0) {
            if($product->discount_id != '' && $product->discount_price != ''){
            $input['cost_price'] = $this->get_cost_price($product->discount_price, $product->commission_rate, $product->additional_rate);
            $input['hd_price'] = $this->get_HD_price($product->discount_price, $input['cost_price']);   
            }else{
            if($request->has('additional_rate')){
                if($request->input('additional_rate') != ''){
                $additional_rate = number_format($request->input('additional_rate'), 2);
                // print_r($additional_rate);
                // exit();
                $input['cost_price'] = $this->get_cost_price($product->normal_price, $product->commission_rate, $additional_rate);   
                }
            }
            $input['cost_price'] = $this->get_cost_price($product->normal_price, $product->commission_rate, $product->additional_rate);
            $input['hd_price'] = $this->get_HD_price($product->normal_price, $input['cost_price']);   
            }
            
            if ($request->input('spec_times') == 1) {
                $input['date_start'] = (!empty($request->input('date_start')) ) ? $request->input('date_start') : NULL;
                $input['date_finish'] = (!empty($request->input('date_finish')) ) ? $request->input('date_finish') : NULL;
            }
            
            $input['advert_ID'] = $this->get_advert_id(8);
            $input['advert_type'] = 'deal';
            $input['commission_rate'] = $product->commission_rate;
            $input['bus_ID'] = $business->bus_ID;
            $input['status'] = '1';
            Advert::create($input);
        }
    }
     private function voucher_store($request) {
        $input = $request->input();
        $total_voucher=$request->input('total_voucher');
        $user_id = Auth()->guard('frontend')->user()->id;
        $business = Business::select('bus_ID')->where('user_id', $user_id)->first();
        $product = Product::select('normal_price')->where('prod_ID', $request->input('prod_ID'))->first();
        if (count($business) > 0) {
            $input['advert_ID'] = $this->get_advert_id(8);
            $input['advert_type'] = 'voucher';
            $input['bus_ID'] = $business->bus_ID;
            $input['status'] = '1';
            $input['voucher_amount'] = $request->input('v_amount');
            $input['voucher_expiry'] = $request->input('voucher_expiery');
            for($i=1;$i<=$total_voucher;$i++){
            $voucher['advert_ID'] = $input['advert_ID'];
            $voucher['voucher_ID']=$this->rand_string(12);
            $voucher['bus_ID'] = $business->bus_ID;
            $voucher['redeem'] = '2';
            $voucher['status'] = '1';
            VoucherDetail::create($voucher);
        }
            Advert::create($input);
        }
    }

    public function get_advert_id() {
        $unique_id = strtoupper(substr(md5(time() . rand()), 17, 4));
        $checkProductId = Advert::where('advert_ID', $unique_id)->count();
        if ($checkProductId !== 0) {
            return $this->get_advert_id();
        } else {
            return $unique_id;
        }
    }

    public static function get_cost_price($normal_price, $commisionrate, $additonalrate) {
        $cost_price = $normal_price;
//        $user_id = Auth()->guard('frontend')->user()->id;
//        $business = Business::select('commission_rate', 'additional_rate')->where('user_id', $user_id)->first();
//        if (count($business) > 0) {
        // echo($additonalrate);
        // exit();
        $commision = ($normal_price * $commisionrate) / 100;
        $additional = ($normal_price * $additonalrate) / 100;
        $cost_price = ($normal_price - ($commision + $additional));

        return $cost_price;
    }   

    public static function get_HD_price($normal_price, $cost_price) {
        $selling_percentage = Setting::select('default', 'value')->where('slug', 'selling_percentage')->first();
        if (count($selling_percentage) > 0) {
            $pecrcentage = ($selling_percentage->value !== NULL) ? $selling_percentage->value : $selling_percentage->default;
            $best_pecrcentage = ($normal_price * $pecrcentage) / 100;
            $hd_price = $cost_price + $best_pecrcentage;
        } else {
            $best_pecrcentage = ($normal_price * 8) / 100;
            $hd_price = $cost_price + $best_pecrcentage;
        }
        return $hd_price;
    }
    public function redeem(request $request){
        return view('advert.redeem');

    }
    

}
