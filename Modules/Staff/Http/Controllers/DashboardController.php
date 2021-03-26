<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\Auth;
use App\Business;
use App\Product;
use App\Advert;

class DashboardController extends StaffController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        $data = [];
        $data['total_vendors'] = Business::where('hd_staff_link', Auth()->guard('staff')->user()->id)->count();
        $data['total_products'] = Product::leftJoin('businesses', 'businesses.bus_ID', 'products.bus_ID')->where('businesses.hd_staff_link', Auth()->guard('staff')->user()->id)->where('products.status', '<>', '3')->count('products.prod_ID');
        $data['total_advert'] = Advert::leftJoin('businesses', 'businesses.bus_ID', 'adverts.bus_ID')->where('businesses.hd_staff_link', Auth()->guard('staff')->user()->id)->where('adverts.status', '<>', '3')->count('adverts.advert_ID');
        $data['total_deal'] = Advert::leftJoin('businesses', 'businesses.bus_ID', 'adverts.bus_ID')->where('businesses.hd_staff_link', Auth()->guard('staff')->user()->id)->where('advert_type', '=', 'deal')->where('status', '<>', '3')->count('adverts.advert_ID');
        $data['total_voucher'] = Advert::leftJoin('businesses', 'businesses.bus_ID', 'adverts.bus_ID')->where('businesses.hd_staff_link', Auth()->guard('staff')->user()->id)->where('advert_type', '=', 'voucher')->where('status', '<>', '3')->count('adverts.advert_ID');
        return view('staff::dashboard.index', $data);
    }

}
