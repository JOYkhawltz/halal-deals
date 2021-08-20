<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use URL;
use Illuminate\Support\Facades\Redirect;
/* * ***************Models******************* */
use App\Product;
use App\ProductType;
use App\ProductSubType;
use App\Advert;
use App\Business;
use App\OrderMaster;
use Mapper;

class SearchController extends Controller {

    public function index() {
        $data = [];
        $data['limit'] = 12;
        $data['offset'] = 0;
        $data['title'] = (isset($_GET['title'])) ? $_GET['title'] : NULL;
        if (isset($_GET['category'])) {
            $data['headcategories'] = $_GET['category'];
        } else {
            $data['headcategories'] = [0];
        }

        $data['town'] = (isset($_GET['town'])) ? $_GET['town'] : NULL;
        $data['city'] = (isset($_GET['city'])) ? $_GET['city'] : NULL;

        if (isset($_GET['subcategory'])) {
                $data['subcategory'] = implode(',', $_GET['subcategory']) ;
            
        } else {
            $data['subcategory'] = '';
        }

        $data['postcode'] = (isset($_GET['post_code'])) ? $_GET['post_code'] : NULL;
        $data['min_price'] = (isset($_GET['min_price'])) ? $_GET['min_price'] : NULL;
        $data['max_price'] = (isset($_GET['max_price'])) ? $_GET['max_price'] : NULL;
        $data['categories'] = ProductType::select('id', 'name')->where('status', '1')->get();

        $data['halals']= ['HMC Approved' => '1', 'HFA Approved' => '2', 'Other Certification'=>'3', 'No certification but fully Halal'=>'4' 
        , 'Non halal meat also served'=>'5', 'Halal upon request only-predominantly non halal meat served' => '6', 'N/A' => '7'];
        return view('search.index', $data);
    }
    
    public function hot_offers()
    {
        $data=[];
        $data['limit'] = 12;
        $data['offset'] = 0;
        $data['hot_deals'] = Advert::with("business")->where('advert_type', '=', 'deal')->where('deal_end', '>=', Carbon::now(get_local_time())->format('Y-m-d'))->where('status', '1')->where('hotoffer',1)->get();
        return view('search.hot_offers', $data);
    }

//    public function get_coupon_search() {
//        $data = [];
//        $data['limit'] = 12;
//        $data['offset'] = 0;
//        if (isset($_GET['category'])) {
//            $data['headcategories'] = $_GET['category'];
//        } else {
//            $data['headcategories'] = [0];
//        }
//
//        $data['town'] = (isset($_GET['town'])) ? $_GET['town'] : NULL;
//        $data['city'] = (isset($_GET['city'])) ? $_GET['city'] : NULL;
//
//        if (isset($_GET['subcategory'])) {
//                $data['subcategory'] = implode(',', $_GET['subcategory']) ;
//            
//        } else {
//            $data['subcategory'] = '';
//        }
//
//        $data['postcode'] = (isset($_GET['post_code'])) ? $_GET['post_code'] : NULL;
//        $data['min_price'] = (isset($_GET['min_price'])) ? $_GET['min_price'] : NULL;
//        $data['max_price'] = (isset($_GET['max_price'])) ? $_GET['max_price'] : NULL;
//        $data['categories'] = ProductType::select('id', 'name')->where('status', '1')->get();
//        return view('search.index', $data);
//    }
    
    public function post_hotdeal_search(Request $request){
        if ($request->ajax()) {
            $data_msg = [];
            $limit = $request->input('limit');
            $offset = $request->input('offset');
            $model = Advert::select('adverts.advert_ID','adverts.prod_ID', 'adverts.title', 'adverts.smallprint', 'adverts.cost_price','adverts.hd_price', 'adverts.prod_ID','businesses.name')
                    ->leftJoin('products', 'products.prod_ID', '=', 'adverts.prod_ID')
                    ->leftJoin('businesses', 'businesses.bus_ID', '=', 'adverts.bus_ID')
                    ->where('deal_end', '>=', Carbon::now()->format('Y-m-d'))
                    ->where('adverts.status', '=', '1')
                    ->where('adverts.hotoffer', '=', '1');
            $model = $model->limit($limit + 1)->offset($offset)->get();
            if (count($model) > 0) {
                if (count($model) === 13)
                    $data_msg['offset'] = (($offset + count($model)) - 1);
                else
                    $data_msg['offset'] = ($offset + count($model));
                $data_msg['limit'] = $limit;
                $data_msg['total'] = count($model);
                $data_msg['type'] = 'success';
            } else {
                $data_msg['type'] = 'failure';
            }
            $data_msg['content'] = view('search.hot_deal_listing', compact('model', 'limit'))->render();
            return response()->json($data_msg);
        }
    }

    public function post_coupon_search(Request $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $limit = $request->input('limit');
            $offset = $request->input('offset');
            $model = Advert::select('adverts.advert_ID','adverts.prod_ID', 'adverts.title', 'adverts.smallprint', 'adverts.cost_price','adverts.hd_price', 'adverts.prod_ID','businesses.name')
                    ->leftJoin('products', 'products.prod_ID', '=', 'adverts.prod_ID')
                    ->leftJoin('businesses', 'businesses.bus_ID', '=', 'adverts.bus_ID')
                    ->where('deal_end', '>=', Carbon::now()->format('Y-m-d'))
                    ->where('adverts.status', '=', '1');
            if (!empty($request->input('title'))) {
                $model->where('products.name', 'like', '%' . $request->input('title') . '%');
            }
            if (!empty($request->input('town'))) {
                $model->where('businesses.town', 'like', '%' . $request->input('town') . '%');
            }
            if (!empty($request->input('city'))) {
                $model->where('businesses.city', 'like', '%' . $request->input('city') . '%');
            }
            if (!empty($request->input('post_code'))) {
                $model->where('businesses.post_code', '=', $request->input('post_code'));
            }
            if (!empty($request->input('min_price'))) {
                $model->where('adverts.hd_price', '>=', $request->input('min_price'));
            }
            if (!empty($request->input('max_price'))) {
                $model->where('adverts.hd_price', '<=', $request->input('max_price'));
            }
            if (!empty($request->input('category'))) {
                $model->whereIn('products.type', $request->input('category'));
            }
            if (!empty($request->input('subcategory'))) {
                $model->whereIn('products.sub_type', $request->input('subcategory'));
            }
            if (!empty($request->input('halal_cert'))) {
                $model->where('businesses.halal_cert', '=', $request->input('halal_cert'));
            }
            if (!empty($request->input('alchohol_served'))) {
                $model->where('businesses.alchohol_served', '=', $request->input('alchohol_served'));
            }
            if (!empty($request->input('male_service'))) {
                $model->where('businesses.male_service', '=', $request->input('male_service'));
            }
            if (!empty($request->input('female_service'))) {
                $model->where('businesses.female_service', '=', $request->input('female_service'));
            }
            if (!empty($request->input('gender_segregated'))) {
                $model->where('businesses.gender_segregated', '=', $request->input('gender_segregated'));
            }
            if (!empty($request->input('sortby'))) {
                if ($request->input('sortby') == 'htl') {
                    $model->orderBy('adverts.cost_price', 'DESC');
                }
                if ($request->input('sortby') == 'lth') {
                    $model->orderBy('adverts.cost_price', 'ASC');
                }
            } else {
                $model->inRandomOrder();
            }
            $model = $model->limit($limit + 1)->offset($offset)->get();
            if (count($model) > 0) {
                if (count($model) === 13)
                    $data_msg['offset'] = (($offset + count($model)) - 1);
                else
                    $data_msg['offset'] = ($offset + count($model));
                $data_msg['limit'] = $limit;
                $data_msg['total'] = count($model);
                $data_msg['type'] = 'success';
            } else {
                $data_msg['type'] = 'failure';
            }
            $data_msg['content'] = view('search.listing', compact('model', 'limit'))->render();
            return response()->json($data_msg);
        }
    }

    public function get_head_subcategory(Request $request) {
        if ($request->ajax()) {
            $data = [];
            $category = $request->input('category');
            
            $sub_categories_html = "";
            if (!empty($category)) {
                $sub_categories = ProductSubType::select('id', 'name')->whereIn('parent_id', $category)->where('status', '1')->get();
                if (count($sub_categories) > 0) {
                    foreach ($sub_categories as $i => $row) {
                        $sub_categories_html .= '<li>
                                     <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" name="subcategory[]" class="custom-control-input" id="checksub_' . $i . '" value="' . $row->id . '" >
                                        <label class="custom-control-label" for="checksub_' . $i . '">' . $row->name . '</label>
                                    </div>
                                </li>';
                    }
                    $data['sub_categories'] = $sub_categories_html;
                }
            }
            return response()->json($data);
        }
    }

    public function get_subcategory(Request $request) {
        if ($request->ajax()) {
            $data = [];
            $category = $request->input('category');
            $sc = !empty($request->input('sc'))?explode(',',$request->input('sc')):[0];
            $sub_categories_html = "";
            if (!empty($category)) {
                $sub_categories = ProductSubType::select('id', 'name')->whereIn('parent_id', $category)->where('status', '1')->get();
                if (count($sub_categories) > 0) {
                    foreach ($sub_categories as $i => $row) {
                        $sub_categories_html .= '<li><div class="custom-control custom-checkbox mr-sm-2"><input type="checkbox" name="subcategory[]" class="custom-control-input" id="checksub_' . $i . '" value="' . $row->id . '"'.(in_array($row->id,$sc)?'checked':'');
                        $sub_categories_html .= ' onclick="loadProducts(0)"><label class="custom-control-label" for="checksub_' . $i . '">' . $row->name . '</label></div></li>';
                    }
                    $data['sub_categories'] = $sub_categories_html;
                }
            }
            return response()->json($data);
        }
    }

    public function get_advert_details($id) {
        $data = [];
        $data['advert_detail'] = $details = Advert::findOrFail($id);

        $com_rate = $add_rate = 0;
        $data['model'] = $model = Product::findOrFail($details->prod_ID);
        $data['bus_desc'] = $bus_detail = Business::findOrFail($details->bus_ID);
        $data['adverts'] = Advert::where('prod_ID', $details->prod_ID)->where('date_finish', '>=', Carbon::now()->format('Y-m-d'))->where('status', '=', '1')->where('advert_ID', '<>', $id)->get();
//        print_r($data);die;
        Mapper::map(25.105128817993943, 67.28984626835889);
        if (count($model) > 0 && $model->status != '3') {
            return view('site.dealdetails', $data);
        }
        
        if ($details->other_options_available == '2') {
            return view('site.dealdetails', $data);
        } else {
            if ($details->new_cust_only == '1') {
                $user_id = Auth()->guard('frontend')->user()->id;
                $order = OrderMaster::where('user_id', $user_id)->count();
                if ($order > 0) {
                    return \Redirect::back()->with('error', 'This is only for new customer ');
                } else {
                    return view('site.dealdetails', $data);
                }
            } else {
                return view('site.dealdetails', $data);
            }
        }
        
    }

}
