<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\OrderDetails;

class CustomerorderController extends Controller
{
    public function index()
    {
        $user_id = Auth()->guard('frontend')->user()->id;
        $data['models'] = OrderDetails::where('user_id',$user_id)->orderBy('id', 'DESC')->paginate(20);
        return view('order.customer_order_view',$data);
    }
}
