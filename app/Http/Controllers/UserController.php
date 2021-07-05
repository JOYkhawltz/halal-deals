<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Charts;
//********** Requests ************//
use App\Http\Requests\CustomerEditprofileRequest;
use App\Http\Requests\ChangePasswordRequest;
//********** Models ************//
use App\User;
use App\Business;
use App\ProductSubType;
use App\ProductType;
use App\Product;
use App\Advert;
use App\Notification;
use App\OrderDetails;
use App\Country;
use App\VoucherDetail;
class UserController extends Controller {

    public function get_dashboard() {
        $data = [];
        if (Auth::guard('frontend')->user()->type_id === '3') {
            $bus_ID = Business::select('bus_ID')->where('user_id', auth()->guard('frontend')->user()->id)->first();
            $data['total_product'] = Product::where('bus_ID', $bus_ID->bus_ID)->where('status', '<>', '3')->count();
            $data['total_deal'] = Advert::where('bus_ID', $bus_ID->bus_ID)->where('advert_type', '=', 'deal')->where('status', '<>', '3')->whereMonth('deal_end', '>=', date('m'))->whereYear('deal_end', '>=', date('Y'))->count();
            $data['total_voucher'] = VoucherDetail::where('bus_ID', $bus_ID->bus_ID)->where('redeem','2')->count();
            //$data['total_voucher'] =VoucherDetail::where('status', '1')->where('redeem','2')->where('bus_ID',$bus_id->bus_ID)->count();
//            $data['total_voucher'] = Advert::where('bus_ID', $bus_ID->bus_ID)->where('advert_type', '=', 'voucher')->where('status', '<>', '3')->count();
//            $data['total_sold_voucher'] = OrderDetails::where('bus_ID', $bus_ID->bus_ID)->where('type', 'voucher')->where('status', '3')->whereMonth('created_at', '=', date('m'))->whereYear('created_at', date('Y'))->sum('quantity');
            $data['total_sold_deal'] = OrderDetails::where('bus_ID', $bus_ID->bus_ID)->where('type', 'deal')->where('status', '3')->whereMonth('created_at', '=', date('m'))->whereYear('created_at', date('Y'))->sum('quantity');
            $data['gross_sales'] = OrderDetails::where('bus_ID', $bus_ID->bus_ID)->where('status', '3')->whereMonth('created_at', '=', date('m'))->whereYear('created_at', date('Y'))->get();
            return view('user.vendor_dashboard', $data);
        } else if (Auth::guard('frontend')->user()->type_id === '4') {
//            $data['total_voucher'] = OrderDetails::where('user_id', auth()->guard('frontend')->user()->id)->where('type', 'voucher')->where('status', '3')->sum('quantity');
            $data['total_deal'] = OrderDetails::where('user_id', auth()->guard('frontend')->user()->id)->where('type', 'deal')->where('status', '3')->sum('quantity');
            return view('user.customer_dashboard', $data);
        }
    }

    public function edit_profile() {
        $model = User::find(Auth::guard('frontend')->user()->id);
        if ($model->type_id === '3') {
            $business = Business::where('user_id', $model->id)->first();
            $product_types = ProductType::where('status', '1')->get();
            return view('user.edit_profile', compact('model', 'business', 'product_types'));
        } else if ($model->type_id === '4') {
            $country = Country::where('status','1')->get();
            return view('user.edit_profile', compact('model','country'));
        }
    }

    public function post_profile(CustomerEditprofileRequest $request) {
        if ($request->ajax()) {
            $data = [];
            $model = User::findOrFail(Auth::guard('frontend')->user()->id);
            $input = $request->only('first_name', 'last_name', 'email', 'phone','title','dob');
            $input['dob']=date("Y-m-d", strtotime($request->input('dob')));
            if ($request->hasFile('image')) {
                $input['image'] = $this->imageUpload($request);
            }
            if ($model->type_id === '3') {
                $this->add_business($request, $model->id);
            }
            if ($model->type_id === '4') {
                $input['address1'] = $request->input('address1_cust');
                $input['address2'] = $request->input('address2_cust');
                $input['country'] = $request->input('country');
                $input['town'] = $request->input('town_cust');
                $input['city'] = $request->input('city_cust');
                $input['post_code'] = $request->input('post_code_cust');
            }
            if ($model->update($input)) {
                if ($model->type_id === '3') {
                    $data['msg'] = "Profile and Business information updated successfully.";
                } else {
                    $data['msg'] = "Profile updated successfully.";
                }
            }
            $notification = [];
            $user_id = Auth::guard('frontend')->user()->id;
            $notification['from_id'] = $user_id;
            $notification['notifiers_id'] = $user_id;
            $notification['type'] = '1';
            if ($model->type_id === '3') {
                $notification['notify_msg'] = "Profile and Business information updated successfully.";
            } else {
                $notification['notify_msg'] = "Profile updated successfully.";
            }
            $notification['status'] = '0';
            Notification::create($notification);
            return response()->json($data);
        }
    }

    public static function add_business($request, $id) {
        $business = Business::where('user_id', $id)->first();
        $input = $request->only('name', 'address1', 'address2', 'town', 'city', 'post_code', 'telphone_no', 'website', 'contact_name', 'contact_no', 'introduction', 'details', 'halal_cert', 'alchohol_served', 'male_service', 'female_service', 'gender_segregated', 'family_area', 'smallprint');
        if ($request->has('prod_types')) {
            $input['prod_types'] = implode(",", $request->input('prod_types'));
        }
        if ($request->has('prod_sub_types')) {
            $input['prod_sub_types'] = implode(",", $request->input('prod_sub_types'));
        }
        $business->update($input);
    }

    function imageUpload(Request $request) {
        if ($request->hasFile('image')) {  //check the file present or not
            $image = $request->file('image'); //get the file
            $name = $this->rand_string(15) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
            $destinationPath = public_path('uploads/frontend/profile_picture/original/'); //public path folder dir
            $path = public_path('uploads/frontend/profile_picture/');
            Image::make($image->getRealPath())->resize(300, 300)->save($path . 'preview/' . $name);
            Image::make($image->getRealPath())->resize(100, 100)->save($path . 'thumb/' . $name);
            $image->move($destinationPath, $name);
            return $name;
        }
    }

    public function notification() {
        $user_id = Auth::guard('frontend')->user()->id;
        $data['allcount'] = Notification::where('notifiers_id', $user_id)->where('status', '<>', '3')->count();
        $rowperpage = 5;
        $data['models'] = Notification::where('notifiers_id', $user_id)->where('status', '<>', '3')->orderBy('id', 'DESC')->skip(0)->take($rowperpage)->get();
        return view('user.notification', $data);
    }

    public function read_notification($id) {
        $model = Notification::findorFail($id);
        if (count($model) > 0) {
            $model->update(['status' => '1']);
        }
        if ($model->type == '1') {
            return Redirect::Route('my-profile');
        } elseif ($model->type == '2') {
            return Redirect::back();
        } elseif ($model->type == '3') {
            if (Auth::guard('frontend')->user()->type_id === '3') {
                return Redirect::Route('order');
            } elseif (Auth::guard('frontend')->user()->type_id === '4') {
                return Redirect::Route('customer-order-details');
            }
        } elseif ($model->type == '4') {
            return Redirect::back();
        } elseif ($model->type == '5') {
            return Redirect::back();
        } elseif ($model->type == '6') {
            return Redirect::Route('get-product-list');
        } elseif ($model->type == '7') {
            return Redirect::Route('get-advert-deal-list');
        } elseif ($model->type == '8') {
            return Redirect::Route('get-advert-voucher-list');
        } elseif ($model->type == '9') {
            return Redirect::Route('withdrawal-wallet');
        } else {
            return Redirect::back()->with('msg', 'Notification readed');
        }
    }

//    public function delete_notification($id) {
//        $model = Notification::findorFail($id);
//        if (count($model) > 0) {
//            $model->update(['status' => '3']);
//        }
//        return Redirect::back()->with('msg', 'Notification readed');
//    }
    public function load_notification(Request $request) {
        $row = $request->input('row');
        $rowperpage = 5;
        $user_id = Auth::guard('frontend')->user()->id;
        $models = Notification::where('notifiers_id', $user_id)->where('status', '<>', '3')->orderBy('id', 'DESC')->skip($row)->take($rowperpage)->get();
        $html = '';

        foreach ($models as $model) {
            $html .= '<div class="success alert-success text-center" role="success">';
            if ($model->type == '1') {
                $html .= '<i class="icofont-ui-user"></i>';
            } elseif ($model->type == '2') {
                $html .= '<i class="icofont-cart-alt"></i>';
            } elseif ($model->type == '3') {
                $html .= '<i class="icofont-history"></i>';
            } elseif ($model->type == '4') {
                $html .= '<i class="icofont-pay"></i>';
            } elseif ($model->type == '5') {
                $html .= '<i class="icofont-ui-rating"></i>';
            } elseif ($model->type == '6') {
                $html .= '<i class="icofont-box"></i>';
            } elseif ($model->type == '7') {
                $html .= '<i class="icofont-ticket"></i>';
            } elseif ($model->type == '8') {
                $html .= '<i class="icofont-ticket"></i>';
            } elseif ($model->type == '9') {
                $html .= '<i class="icofont-wallet"></i>';
            }
            $html .= ' &nbsp;&nbsp;';
            if ($model->status == '1') {
                $html .= '<a href=" ' . Route('read-notification', ['id' => $model->id]) . '">' . $model->notify_msg . '</a>';
            } else {
                $html .= '<a href="' . Route('read-notification', ['id' => $model->id]) . '"> <b>' . $model->notify_msg . '</b></a>';
            }
            $html .= '<br/>';
            $html .= \Carbon\Carbon::parse($model->created_at)->format('d F Y');
            $html .= '<hr>';
            $html .= '</div>';
        }
        $data['html'] = $html;
        return response()->json($data);
    }

    public function countnotification() {
        $user_id = Auth::guard('frontend')->user()->id;
        $data_msg['notifiaction'] = Notification::where('notifiers_id', $user_id)->where('status', '<>', '3')->count();
        return response()->json($data_msg);
    }

    public function reset_password(ChangePasswordRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $model = User::findOrFail(Auth::guard('frontend')->user()->id);
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $model->update($input);
            $notification = [];
            $user_id = Auth::guard('frontend')->user()->id;
            $notification['from_id'] = $user_id;
            $notification['notifiers_id'] = $user_id;
            $notification['type'] = '1';
            $notification['notify_msg'] = 'Your password changed successfully ';
            $notification['status'] = '0';
            Notification::create($notification);
            $data_msg['msg'] = 'Your password changed successfully.';
            return response()->json($data_msg);
        }
    }

    public function total_sell_chart(Request $request) {
        if ($request->ajax()) {
            $bus_ID = Business::select('bus_ID')->where('user_id', auth()->guard('frontend')->user()->id)->first();
            $data = [];
            $year = !empty($request->input('year')) ? $request->input('year') : date('Y');
            $data_set1 = [];
            $data_set2 = [];
            $label = [];

            for ($i = 1; $i <= 12; $i++) {
                $j = $i - 1;

                $month = date('m', strtotime(date("d-m-" . $year) . " -$j months"));
                $yr = date('Y', strtotime(date("d-m-" . $year) . " -$j months"));
//                print_r($month);exit;
                $label[] = date('F,Y', strtotime(date("d-m-" . $year) . " -$j months"));
//                print_r($label);exit;
//                $total_voucher = OrderDetails::where('type', 'voucher')->where('bus_ID', $bus_ID->bus_ID)->whereMonth('created_at', '=', $month)->whereYear('created_at', $yr)->sum('quantity');
                $total_deal = OrderDetails::where('type', 'deal')->where('bus_ID', $bus_ID->bus_ID)->whereMonth('created_at', '=', $month)->whereYear('created_at', $yr)->sum('quantity');
//                $data_set1[] = $total_voucher;
                $data_set2[] = $total_deal;
            }
            $chart = Charts::multi('bar', 'highcharts')
                    ->title('Item Sold Per Month')
                    ->elementLabel("Total")
                    ->colors(['#ff0000', 'rgb(51, 133, 225)'])
                    ->labels($label)
                    ->dataset('Deal', $data_set2);
//                    ->dataset('Voucher', $data_set1);

            $data['content'] = view('user._chart', compact('chart'))->render();
            $data['status'] = 200;
            return response()->json($data);
        }
    }

    public function profit_per_month(Request $request) {
        if ($request->ajax()) {
            $bus_ID = Business::select('bus_ID')->where('user_id', auth()->guard('frontend')->user()->id)->first();
            $data = [];
            $year = !empty($request->input('year')) ? $request->input('year') : date('Y');
            $data_set1 = [];
            $data_set2 = [];
            $label = [];

            for ($i = 1; $i <= 12; $i++) {
                $j = $i - 1;
                
                $month = date('m', strtotime(date("d-m-" . $year) . " -$j months"));
                $yr = date('Y', strtotime(date("d-m-" . $year) . " -$j months"));
//                print_r($month);exit;
                $label[] = date('F,Y', strtotime(date("d-m-" . $year) . " -$j months"));
//                print_r($label);exit;
                $total_gs = 0;
                $gross_sales = OrderDetails::where('bus_ID', $bus_ID->bus_ID)->where('status', '2')->whereMonth('created_at', '=', $month)->whereYear('created_at', $yr)->get();
                foreach ($gross_sales as $gs) {
                    if ($gs->type == 'deal') {
                        $advert = Advert::where('advert_ID', $gs->advert_id)->first();
                        $total_gs = $total_gs + ($gs->quantity *$advert->cost_price);
                    } 
                }
                $data_set1[] = $total_gs;
                
            }
            $chart = Charts::multi('bar', 'highcharts')
                    ->title('Gross sales')
                    ->elementLabel("Total")
                    ->colors(['#ff0000', 'rgb(51, 133, 225)'])
                    ->labels($label)
                    ->dataset('Gross Sales', $data_set1);

            $data['content'] = view('user._chart', compact('chart'))->render();
            $data['status'] = 200;
            return response()->json($data);
        }
    }

}
