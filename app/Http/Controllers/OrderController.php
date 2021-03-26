<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use URL;
//use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

/* * *************** Model ************ */
use App\Notification;
use App\OrderDetails;
use App\OrderMaster;
use App\User;
use App\Advert;
use App\Country;
use App\Business;

class OrderController extends Controller {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        $data = [];
        $user_id = Auth()->guard('frontend')->user()->id;
        $business = Business::select('bus_ID')->where('user_id', $user_id)->first();
        $data['models'] = OrderDetails::where('bus_ID', $business->bus_ID)->orderBy('id', 'DESC')->paginate(20);
        return view('order.index', $data);
    }

    public function edit_order_details($id) {
        $data = [];
        $data['model'] = $model = OrderDetails::findOrFail($id);
        $data['address'] = $address = OrderMaster::where('id', $model->order_id)->first();
        $data['country'] = Country::where('id', $address->country)->first();
        return view('order.edit_order_details', $data);
    }

    public function view_order_details($id) {
        $data = [];
        $data['model'] = $model = OrderDetails::findOrFail($id);
        $data['address'] = $address = OrderMaster::where('id', $model->order_id)->first();
        $data['country'] = Country::where('id', $address->country)->first();
        return view('order.view', $data);
    }

    public function update_order_status(Request $request, $id) {

        $input['status'] = $status = $request->input('status');
        $advert = OrderDetails::where('id', $id)->first();
        $advert->update($input);
        $notification=[];
        if($status=='1')
        {
            $notification['notify_msg'] = 'Your Order Placed successfully ';
        }elseif ($status=='2') {
            $notification['notify_msg'] = 'Your Order Is Shipped ';
        }elseif ($status=='3') {
            $notification['notify_msg'] = 'Your Order successfully Delivered';
        }
        // $notification['from_id'] = $user_id;
        $notification['notifiers_id'] = $advert->user_id;
        $notification['type'] = '3';
        $notification['status'] = '0';
        Notification::create($notification);
        $data_msg['msg'] = "Order Status updated.";
        $data_msg['link'] = route('order');
        return response()->json($data_msg);
    }

}
