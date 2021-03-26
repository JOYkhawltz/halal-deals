<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\ImageManagerStatic as Image;
use URL;
use Carbon\Carbon;

/* * *************** Request ************ */
use Modules\Staff\Http\Requests\AddProductRequest;
use Modules\Staff\Http\Requests\EditProductRequest;
/* * *************** Model ************ */
use App\Product;
use App\ProductImage;
use App\Business;
use App\User;
use App\Advert;
use App\Setting;
use App\Notification;
use App\Discount;


class ProductController extends StaffController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        return view('staff::product.index');
    }

    public function get_products_list_datatable() {
        $user_id = Auth()->guard('staff')->user()->id;
        $product_list = Product::select('products.*')
                        ->leftJoin('businesses', 'businesses.bus_ID', '=', 'products.bus_ID')
                        ->leftJoin('users', 'users.id', '=', 'businesses.user_id')
                        ->where('products.status', '<>', '3')->where('businesses.hd_staff_link', '=', $user_id)->get('users.first_name as vendor_name');
        return Datatables::of($product_list)
                        ->editColumn('prod_ID', function ($model) {
                            return $model->prod_ID;
                        })
                        ->editColumn('vendor_name', function ($model) {
                            $id = $model->business->user_id;
                            $user = $model->vendor($id);
                            return (isset($user->first_name) ? $user->first_name . ' ' . $user->last_name : 'unknown');
                        })
                        ->editColumn('name', function ($model) {
                            return $model->name;
                        })
                        ->editColumn('normal_price', function ($model) {
                            return '<i class="fa fa-gbp" aria-hidden="true"></i>' . $model->normal_price;
                        })
                        ->editColumn('created_at', function ($model) {
                            return date("Y-m-d H:i:s", strtotime($model->created_at));
                        })
                        ->editColumn('status', function ($model) {
                            return ($model->status === '0') ? '<span class="label label-sm label-warning"> Inactive </span>' : (($model->status === '1') ? '<span class="label label-sm label-success"> Active </span>' : '<span class="label label-sm label-danger"> Delete </span>');
                        })
                        ->addColumn('action', function ($model) {
                            $action_html = '<a href="' . Route('staff-viewproduct', ['prod_ID' => $model->prod_ID]) . '" class="btn btn-outline btn-circle btn-sm blue" data-toggle="tooltip" title="View">'
                                    . '<i class="fa fa-eye"></i>'
                                    . '</a>'
                                    . '<a href="' . Route('staff-updateproduct', ['prod_ID' => $model->prod_ID]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
                                    . '<i class="fa fa-edit"></i>'
                                    . '</a>';
                            return $action_html;
                        })
                        ->rawColumns(['normal_price', 'status', 'action'])
                        ->make(true);
    }

    public function view(Request $request, $id) {
        $data = [];
        $data['model'] = $model = Product::findOrFail($id);
        $data['discount_rate'] = Discount::where('id',$model->discount_id)->where('status','1')->first();
        if (count($model) > 0 && $model->status != '3') {
            return view('staff::product.view', $data);
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
            return redirect()->route('staff-products');
        }
    }

    public function add_product() {
        $vendors = User::where('type_id', '3')->where('status', '1')->get();
        return view('staff::product.add', compact('vendors'));
    }

    public function post_add_product(AddProductRequest $request) {
        if ($request->ajax()) {
            $user_id = Auth()->guard('staff')->user()->id;
            $data_msg = [];
            $product_id = $this->store($request, NULL);
            $this->save_product_images($request, $product_id);
            $advert = Advert::where('prod_ID', $product_id)->first();
            $business = Business::where('bus_ID', $advert->bus_ID)->first();
            $notification = [];
//            $notification['from_id'] = '';
            $notification['notify_view_users'] = 'business';
            $notification['notifiers_id'] = $business->user_id;
            $notification['type'] = '6';
            $notification['notify_msg'] = 'HD staff added a product to your business';
            $notification['status'] = '0';
            Notification::create($notification);
            $notification['notify_view_users'] = 'staff';
            $notification['notifiers_id'] = $user_id;
            $notification['type'] = '6';
            $notification['notify_msg'] = 'HD staff added a product ';
            $notification['status'] = '0';
            Notification::create($notification);
            $notification['notify_view_users'] = 'admin';
            $notification['notifiers_id'] = '';
            $notification['type'] = '6';
            $notification['notify_msg'] = 'HD staff added a product ';
            $notification['status'] = '0';
            Notification::create($notification);
            $data_msg['msg'] = "Product saved successfully.";
            $data_msg['link'] = route('staff-products');
            return response()->json($data_msg);
        }
    }

    public function get_update(Request $request, $id) {
        $data = [];
        $data['model'] = $model = Product::where('prod_ID', '=', $id)->findOrFail($id);
        $data['discount_rate'] = Discount::where('id',$model->discount_id)->where('status','1')->first();
        if (count($model) > 0 && $model->status != '3') {
            return view('staff::product.update', $data);
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
            return redirect()->route('staff-products');
        }
    }

    public function showimages(Request $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $images = [];
            $product_id = $request->input('id');
            $productImages = ProductImage::where(['prod_ID' => $product_id])->where('status', '1')->get();
            if (count($productImages) > 0) {
                foreach ($productImages as $key => $image) {
                    $images[$key]['name'] = $image->image_name;
                    $targetFile = public_path('uploads/frontend/product/original/' . $image->image_name);
                    $images[$key]['size'] = filesize($targetFile);
                    $images[$key]['is_default'] = $image->is_default;
                    $images[$key]['is_side'] = $image->is_side;
                }
                $data_msg['res'] = 1;
                $data_msg['images'] = $images;
            }
            return response()->json($data_msg);
        }
    }

    public function product_photos(Request $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $targetDir = public_path('uploads/frontend/product/original/');
            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $fileName = $this->rand_string(5) . time() . '.' . $ext;
            $targetFile = $targetDir . $fileName;
            move_uploaded_file($_FILES['file']['tmp_name'], $targetFile);
            $data_msg['file_name'] = $fileName;
            $data_msg['modelName'] = 'AllImages';
            return response()->json($data_msg);
        }
    }

    public function post_update(EditProductRequest $request, $id) {
        if ($request->ajax()) {
            $user_id = Auth()->guard('staff')->user()->id;
            $data_msg = [];
            $model = Product::findorFail($id);
            $product_id = $this->store($request, $model->prod_ID);
//            $this->save_product_images($request, $product_id);
            $advert = Advert::where('prod_ID', $product_id)->first();
            $business = Business::where('bus_ID', $advert->bus_ID)->first();
            $notification = [];
//            $notification['from_id'] = '1';
            $notification['notify_view_users'] = 'business';
            $notification['notifiers_id'] = $business->user_id;
            $notification['type'] = '6';
            $notification['notify_msg'] = 'HD staff update a product to your business';
            $notification['status'] = '0';
            Notification::create($notification);
            $notification['notify_view_users'] = 'staff';
            $notification['notifiers_id'] = $user_id;
            $notification['type'] = '6';
            $notification['notify_msg'] = 'HD staff update a product ';
            $notification['status'] = '0';
            Notification::create($notification);
            $notification['notify_view_users'] = 'admin';
            $notification['notifiers_id'] = '';
            $notification['type'] = '6';
            $notification['notify_msg'] = 'HD staff update a product ';
            $notification['status'] = '0';
            Notification::create($notification);
            $data_msg['msg'] = "Product saved successfully.";
            $data_msg['link'] = route('staff-products');
            return response()->json($data_msg);
        }
    }

    public static function save_product_images($request, $product_id) {
        if (!empty($request->input('AllImages')['image']) && !empty($product_id)) {
            $productImages = ProductImage::where(['prod_ID' => $product_id])->where('status', '1')->get();
            if (count($productImages) > 0) {
                foreach ($productImages as $img) {
                    $file1 = public_path('uploads/frontend/product/preview/' . $img->image_name);
                    unlink($file1);
                    $img->delete();
                }
            }
            $count = 0;
            foreach ($request->input('AllImages')['image'] AS $image) {
                $model_image = new ProductImage();
                $model_image->prod_ID = $product_id;
                $model_image->image_name = $image;
                if ($count == $request->input('AllImages')['is_default']) {
                    $model_image->is_default = '1';
                } else {
                    $model_image->is_default = '0';
                }
                Image::make(public_path('uploads/frontend/product/original/') . $image)->resize(300, 200)->save(public_path('uploads/frontend/product/preview/') . $image);
                $model_image->status = '1';
                $model_image->created_at = Carbon::now();
                $model_image->save();
                $count++;
            }
        }
    }

    public function get_product_id() {
        $unique_id = strtoupper(substr(md5(time() . rand()), 17, 4));
        $checkProductId = Product::where('prod_ID', $unique_id)->count();
        if ($checkProductId !== 0 || is_numeric($unique_id)) {
            return $this->get_product_id();
        } else {
            return $unique_id;
        }
    }

    public function store($request, $checkProduct = NULL) {
        $input = $request->all();
        $postage_cost = ($request->has('address_required') && $request->input('address_required') == 1) ? $request->input('postage_cost') : NULL;
        $input['postage_cost'] = $postage_cost;
        if ($checkProduct !== NULL) {
            $product = Product::where('prod_ID', $checkProduct)->where('status', '<>', '3')->first();
            if ($request->input('price_verified_date') === NULL && $request->input('price_verified') == 1) {
                $input['price_verified_date'] = Carbon::now()->format('Y-m-d');
            } else if ($request->input('price_verified') == 2) {
                $input['price_verified_date'] = NULL;
            }
            $product->update($input);
        }
        return $product->prod_ID;
    }

//    public function delete(Request $request, $id) {
//        $model = Product::where('prod_ID', '=', $id)->findOrFail($id);
//        if (count($model) > 0 && $model->status != '3') {
//            $model->update(['status' => '3']);
//            $request->session()->flash('success', 'Product deleted successfully.');
//        } else {
//            $request->session()->flash('danger', 'Oops. Something went wrong.');
//        }
//        return redirect()->route('staff-products');
//    }
}
