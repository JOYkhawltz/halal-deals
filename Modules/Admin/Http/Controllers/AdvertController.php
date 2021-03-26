<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\ImageManagerStatic as Image;
use URL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
/* * *************** Request ************ */
use Modules\Admin\Http\Requests\EditAdvertRequest;
use Modules\Admin\Http\Requests\AddAdvertRequest;
/* * *************** Model ************ */
use App\Product;
use App\ProductImage;
use App\Business;
use App\User;
use App\Advert;
use App\Setting;
use App\Notification;
use App\VoucherDetail;

class AdvertController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function deal_index() {
        return view('admin::advert.dealindex');
    }

    public function voucher_index() {
        return view('admin::advert.voucherindex');
    }

    public function get_advertdeal_list_datatable() {
        $advert_list = Advert::select('*')
                        ->leftJoin('products', 'products.prod_ID', '=', 'adverts.prod_ID')
                        ->where('adverts.status', '<>', '3')->where('adverts.advert_type', '=', 'deal')->get('products.name as name');


        return Datatables::of($advert_list)
                        ->editColumn('advert_ID', function ($model) {
                            return $model->advert_ID;
                        })
                        ->editColumn('product_name', function ($model) {
                            return $model->name;
                        })
                        ->editColumn('cost_price', function ($model) {
                            return $model->cost_price;
                        })
                        ->editColumn('hd_price', function ($model) {
                            return $model->hd_price;
                        })
                        ->editColumn('deal_start', function ($model) {
                            return (!empty($model->deal_start)) ? \Carbon\Carbon::parse($model->deal_start)->format('d F Y') : 'Not Applicable';
                        })
                        ->editColumn('deal_end', function ($model) {
                            return (!empty($model->deal_end)) ? \Carbon\Carbon::parse($model->deal_end)->format('d F Y') : 'Not Applicable';
                        })
                        ->editColumn('status', function ($model) {
                            return ($model->status === '0') ? '<span class="label label-sm label-warning"> Inactive </span>' : (($model->status === '1') ? '<span class="label label-sm label-success"> Active </span>' : '<span class="label label-sm label-danger"> Delete </span>');
                        })
                        ->addColumn('action', function ($model) {
                            $action_html = '<a href="' . Route('admin-viewadvertdeal', ['ID' => $model->advert_ID]) . '" class="btn btn-outline btn-circle btn-sm blue" data-toggle="tooltip" title="View">'
                                    . '<i class="fa fa-eye"></i>'
                                    . '</a>'
//                                    . '<a href="' . Route('admin-updateadvert', ['ID' => $model->advert_ID]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
//                                    . '<i class="fa fa-edit"></i>'
//                                    . '</a>'
                                    . '<a href="javascript:void(0);" onclick="deleteAdvert(this);" data-href="' . Route("admin-deleteadvert", ['id' => $model->advert_ID]) . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
                                    . '<i class="fa fa-trash"></i>'
                                    . '</a>';
                            return $action_html;
                        })
                        ->rawColumns(['status', 'action'])
                        ->make(true);
    }

    public function get_advertvoucher_list_datatable(Request $request) {
        if ($request->ajax()) {
            $voucher_list = VoucherDetail::select('*')->where('status', '1');
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
                            ->editColumn('redeem', function ($model) {
                            if ($model->redeem == '1') {
                                    $redeem = '<span class="pending-status"><i class="icofont-warning"></i>Not redeem</span>';
                                } else if ($model->status == '1') {
                                    $redeem = '<span class="cnf-status"><i class="icofont-check"></i>Redeem</span>';
                                }
                                return $redeem;
                            })
                            
                            
                            ->rawColumns(['status','redeem'])
                            ->make(true);
        }
    }

    public function get_advertvoucherdetail_list_datatable($id) {

        $advert_list = VoucherDetail::select('voucher_details.*','users.first_name','users.last_name')
                        ->leftJoin('users', 'users.id', '=', 'voucher_details.purchasing_user')
                        ->where('voucher_details.status', '<>', '3')->where('voucher_details.advert_ID', '=', $id);


        return Datatables::of($advert_list)
                        ->editColumn('advert_ID', function ($model) {
                            return $model->advert_ID;
                        })
                        ->editColumn('voucher_ID', function ($model) {
                            return $model->voucher_ID;
                        })
                        ->editColumn('redeem', function ($model) {
                            return ($model->redeem === '2') ? '<span class="label label-sm label-warning"> Not redeem </span>' : '<span class="label label-sm label-success"> redeem </span>';
                        })
                        ->editColumn('purchasing_user', function ($model) {
                            
                            return ($model->first_name != '') ?$model->first_name.' '.$model->last_name:'Not Purchasing Yet';
                        })
                        ->editColumn('status', function ($model) {
                            return ($model->status === '0') ? '<span class="label label-sm label-warning"> Inactive </span>' : (($model->status === '1') ? '<span class="label label-sm label-success"> Active </span>' : '<span class="label label-sm label-danger"> Delete </span>');
                        })
                        ->rawColumns(['redeem','status'])
                        ->make(true);
    }

    public function viewdeal(Request $request, $id) {

        $data = [];
        $data['model'] = $model = Advert::findOrFail($id);
        if (count($model) > 0 && $model->status != '3') {
            $data['product'] = Product::findOrFail($model->prod_ID);

            return view('admin::advert.viewdeal', $data);
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
            return redirect()->route('admin-deal-adverts');
        }
    }

    public function viewvoucher(Request $request, $id) {
        $data = [];
        $data['model'] = $model = Advert::findOrFail($id);
        if (count($model) > 0 && $model->status != '3') {
            $data['id'] = $id;
            return view('admin::advert.viewvoucher', $data);
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
            return redirect()->route('admin-voucher-adverts');
        }
    }

//    public function add_advert() {
//        $vendors = User::where('type_id', '3')->where('status', '1')->get();
//        return view('admin::advert.add', compact('vendors'));
//    }
//
//    public function post_add_Advert(AddAdvertRequest $request) {
//        if ($request->ajax()) {
//            $data_msg = [];            
//            $this->store($request, NULL);
//            $product_id = $request->input('prod_ID');
//            $advert= Advert::where('prod_ID',$product_id)->first();
//            $business= Business::where('bus_ID',$advert->bus_ID)->first();
//            $notification = [];
////            $notification['from_id'] = '1';
//            $notification['notify_view_users'] = 'business';
//            $notification['notifiers_id'] = $business->	user_id;
//            $notification['type'] = '7';
//            $notification['notify_msg'] = 'Advert added successfully by admin';
//            $notification['status'] = '0';
//            Notification::create($notification);
//            $notification['notify_view_users'] = 'staff';
//            $notification['notifiers_id'] =  $business->hd_staff_link;
//            $notification['type'] = '7';
//            $notification['notify_msg'] = 'Advert added successfully by admin';
//            $notification['status'] = '0';
//            Notification::create($notification);
//            $notification['notify_view_users'] = 'admin';
//            $notification['notifiers_id'] = '';
//            $notification['type'] = '7';
//            $notification['notify_msg'] = 'Advert added successfully by admin';
//            $notification['status'] = '0';
//            Notification::create($notification);
//            $data_msg['msg'] = "Advert saved successfully.";
//            $data_msg['link'] = route('admin-adverts');
//            return response()->json($data_msg);
//        }
//    }
//    public function get_update(Request $request, $id) {
//
//        $model = Advert::findorFail($id);
//        $products = Product::select('prod_ID', 'name', 'normal_price')->where('bus_ID', $model->bus_ID)->where('status', '1')->get();
//        if (count($model) > 0 && $model->status != '3') {
//            return view('admin::advert.update', compact('model', 'products'));
//        } else {
//            $request->session()->flash('danger', 'Oops. Something went wrong.');
//            return redirect()->route('admin-adverts');
//        }
//    }
//
//    public function post_editadvert(EditAdvertRequest $request) {
//        if ($request->ajax()) {
//            $data = [];
//            $this->store($request, $request->input('id'));
//            $product_id = $request->input('prod_ID');
//            $advert= Advert::where('prod_ID',$product_id)->first();
//            $business= Business::where('bus_ID',$advert->bus_ID)->first();
//            $notification = [];
////            $notification['from_id'] = '1';
//            $notification['notify_view_users'] = 'business';
//            $notification['notifiers_id'] = $business->	user_id;
//            $notification['type'] = '7';
//            $notification['notify_msg'] = 'Advert updated successfully by admin';
//            $notification['status'] = '0';
//            Notification::create($notification);
//            $notification['notify_view_users'] = 'staff';
//            $notification['notifiers_id'] =  $business->hd_staff_link;
//            $notification['type'] = '7';
//            $notification['notify_msg'] = 'Advert added successfully by admin';
//            $notification['status'] = '0';
//            Notification::create($notification);
//            $notification['notify_view_users'] = 'admin';
//            $notification['notifiers_id'] = '';
//            $notification['type'] = '7';
//            $notification['notify_msg'] = 'Advert added successfully by admin';
//            $notification['status'] = '0';
//            Notification::create($notification);
//            $data['msg'] = 'Advert updated successfuly.';
//            $data['link'] = route('admin-adverts');
//            return response()->json($data);
//        }
//    }

    public function get_price(Request $request) {
        if ($request->ajax()) {
            $data = [];

            $data['status'] = "success";
            if (!(is_numeric($request->coupen_discount))) {
                $data['error'] = 'this is not a number';
                $data['status'] = "error";
            } elseif (($request->coupen_discount) <= 8) {
                $data['error'] = 'given number is not greater than 8%';
                $data['status'] = "error";
            } elseif (($request->vendor_id) == '') {
                $data['error'] = 'Please select at least one vendor.';
                $data['status'] = "error";
            } elseif (($request->prod_ID) == '') {
                $data['error'] = 'Please select at least one product.';
                $data['status'] = "error";
            }
            if ($data['status'] == "success") {

                $product = Product::select('normal_price')->where('prod_ID', $request->input('prod_ID'))->first();
                if (count($product) > 0) {
                    $cost_price = $this->get_cost_price($product->normal_price, $request->input('coupen_discount'), $request->input('additional_discount'));
                    $hd_price = $this->get_HD_price($product->normal_price, $cost_price);
                } else {
                    $cost_price = $request->input('price');
                    $hd_price = $this->get_HD_price($product->normal_price, $cost_price);
                }
                if ($cost_price <= 0) {
                    $data['cost_price_error'] = "error";
                } else {
                    $data['cost_price'] = number_format($cost_price, 2);
                    $data['hd_price'] = number_format($hd_price, 2);
                }
            }
            return response()->json($data);
        }
    }

    public function additonal_discount(Request $request) {
        if ($request->ajax()) {
            $data = [];

            $data['status'] = "success";
            if (isset($request->additional_discount)) {
                if (!(is_numeric($request->additional_discount))) {
                    $data['error'] = 'this is not a number';
                    $data['status'] = "error";
                } elseif (($request->vendor_id) == '') {
                    $data['error'] = 'Please select at least one vendor.';
                    $data['status'] = "error";
                } elseif (($request->prod_ID) == '') {
                    $data['error'] = 'Please select at least one product.';
                    $data['status'] = "error";
                }
            }
            if ($data['status'] == "success") {

                $product = Product::select('normal_price')->where('prod_ID', $request->input('prod_ID'))->first();
                if (count($product) > 0) {
                    $cost_price = $this->get_cost_price($product->normal_price, $request->input('coupen_discount'), $request->input('additional_discount'));
                    $hd_price = $this->get_HD_price($product->normal_price, $cost_price);
                } else {
                    $cost_price = $request->input('price');
                    $hd_price = $this->get_HD_price($product->normal_price, $cost_price);
                }
                if ($cost_price <= 0) {
                    $data['cost_price_error'] = "error";
                } else {
                    $data['cost_price'] = number_format($cost_price, 2);
                    $data['hd_price'] = number_format($hd_price, 2);
                }
            }
            return response()->json($data);
        }
    }

    public static function product_list(Request $request) {
        $data = [];
        $products = Product::select('prod_ID', 'name', 'normal_price')->where('bus_ID', $request->id)->where('status', '1')->get();
        foreach ($products as $product) {
            $data['action_html'] = '<select class="form-control" name="prod_ID" id="prod_ID" onchange="changePrice(this)">'
                    . '<option value="">Choose One Product</option>'
                    . '<option value="' . $product->prod_ID . '" data-id="' . $product->prod_ID . '" data-price="' . $product->normal_price . '">' . $product->name . '</option>'
                    . ' .empty .'
                    . '</select>';
        }
        return response()->json($data);
    }

    public static function get_cost_price($normal_price, $commisionrate, $additonalrate) {
        $cost_price = $normal_price;
        $commision = ($normal_price * $commisionrate) / 100;
        $additional = ($normal_price * $additonalrate) / 100;
        $cost_price = ($normal_price - ($commision + $additional));

        return $cost_price;
    }

    private function store($request, $advert_id = NULL) {

        $data['commission_rate'] = $request->input('coupen_discount');
        $data['additional_rate'] = $request->input('additional_discount');
        $business = Business::select('commission_rate', 'additional_rate')->where('bus_ID', $request->input('vendor_id'))->first();
        $product = Product::select('normal_price')->where('prod_ID', $request->input('prod_ID'))->first();
        if (count($business) > 0) {
            if ($request->input('advert_type') == 'voucher') {
                $input = $request->except('deal_start', 'deal_end');
            } else {
                $input = $request->input();
            }

            $input['voucher_expiry'] = $request->input('v_exp_date');
            $input['commission_rate'] = $request->input('coupen_discount');
            $input['additional_rate'] = $request->input('additional_discount');
            $input['cost_price'] = $this->get_cost_price($product->normal_price, $input['commission_rate'], $input['additional_rate']);
            $input['hd_price'] = $this->get_HD_price($product->normal_price, $input['cost_price']);
            $input['spec_times_details'] = ($request->input('spec_times') == 1) ? $request->input('spec_times_details') : NULL;
            $checkAdvert = Advert::where('advert_ID', $advert_id)->where('bus_ID', $request->input('vendor_id'))->where('status', '1')->first();
            if (count($checkAdvert) > 0) {
                $checkAdvert->update($input);
            } else {
                $input['advert_type'] = $request->input('advert_type');
                $input['advert_ID'] = $this->get_advert_id(8);
                $input['bus_ID'] = $request->input('vendor_id');
                $input['status'] = '1';
                Advert::create($input);
            }
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

    public function delete(Request $request, $id) {
        $model = Advert::where('advert_ID', '=', $id)->findOrFail($id);
        if (count($model) > 0 && $model->status != '3') {
            $model->update(['status' => '3']);
            $request->session()->flash('success', 'Product deleted successfully.');
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return Redirect::back();
    }

}
