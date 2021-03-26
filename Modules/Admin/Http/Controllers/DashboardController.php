<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\Auth;
use Charts;
use App\User;
use App\Product;
use App\ProductType;
use App\Advert;
use App\OrderDetails;

class DashboardController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        $data = [];
        $data['total_users'] = User::where('type_id', '<>', '1')->count();
        $data['total_customers'] = User::where('type_id', '=', '4')->where('status', '<>', '3')->count();
        $data['total_business_managers'] = User::where('type_id', '=', '3')->where('status', '<>', '3')->count();
        $data['total_business_admins'] = User::where('type_id', '=', '2')->where('status', '<>', '3')->count();
        $data['total_product'] = Product::where('status', '<>', '3')->count();
        $data['total_product_type'] = ProductType::where('status', '<>', '3')->count();
        $data['total_advert'] = Advert::where('status', '<>', '3')->count();
        $data['total_deal'] = Advert::where('advert_type', '=', 'deal')->where('status', '<>', '3')->count();
        $data['total_voucher'] = Advert::where('advert_type', '=', 'voucher')->where('status', '<>', '3')->count();
        return view('admin::dashboard.index', $data);
    }

    public function total_sell_chart(Request $request) {
        if ($request->ajax()) {
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
                $total_voucher = OrderDetails::where('type', 'voucher')->whereMonth('created_at', '=', $month)->whereYear('created_at', $yr)->sum('quantity');
                $total_deal = OrderDetails::where('type', 'deal')->whereMonth('created_at', '=', $month)->whereYear('created_at', $yr)->count();
                $data_set1[] = $total_voucher;
                $data_set2[] = $total_deal;
            }
            $chart = Charts::multi('bar', 'highcharts')
                    ->title('Total sells chart')
                    ->elementLabel("Total")
                    ->colors(['#ff0000', 'rgb(51, 133, 225)'])
                    ->labels($label)
                    ->dataset('Deal', $data_set2)
                    ->dataset('Voucher', $data_set1);

            $data['content'] = view('admin::dashboard._chart', compact('chart'))->render();
            $data['status'] = 200;
            return response()->json($data);
        }
    }

    public function profit_per_month(Request $request) {
        if ($request->ajax()) {
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
                $gross_sales = OrderDetails::where('status', '3')->whereMonth('created_at', '=', $month)->whereYear('created_at', $yr)->get();
                foreach ($gross_sales as $gs) {
                    $total_gs = $total_gs + ($gs->quantity * $gs->item_price);
                }
                $data_set1[] = $total_gs;
            }
            $chart = Charts::multi('bar', 'highcharts')
                    ->title('Gross sales')
                    ->elementLabel("Total")
                    ->colors(['#ff0000', 'rgb(51, 133, 225)'])
                    ->labels($label)
                    ->dataset('Gross Sales', $data_set1);

            $data['content'] = view('admin::dashboard._chart', compact('chart'))->render();
            $data['status'] = 200;
            return response()->json($data);
        }
    }

}
