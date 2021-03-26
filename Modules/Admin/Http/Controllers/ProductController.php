<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\ImageManagerStatic as Image;
use URL;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
/* * *************** Request ************ */
use Modules\Admin\Http\Requests\AddProductRequest;
use Modules\Admin\Http\Requests\EditProductRequest;
/* * *************** Model ************ */
use App\Product;
use App\ProductImage;
use App\Business;
use App\User;
use App\Advert;
use App\Setting;
use App\Notification;
use App\ProductSubType;
use App\Discount;

class ProductController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        return view('admin::product.index');
    }

    public function get_products_list_datatable() {
        $product_list = Product::select('products.*')
                        ->leftJoin('businesses', 'businesses.bus_ID', '=', 'products.bus_ID')
                        ->leftJoin('users', 'users.id', '=', 'businesses.user_id')
                        ->where('products.status', '<>', '3')->get('users.first_name as vendor_name');

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
                            $action_html = '<a href="' . Route('admin-viewproduct', ['prod_ID' => $model->prod_ID]) . '" class="btn btn-outline btn-circle btn-sm blue" data-toggle="tooltip" title="View">'
                                    . '<i class="fa fa-eye"></i>'
                                    . '</a>'
                                    . '<a href="' . Route('admin-updateproduct', ['prod_ID' => $model->prod_ID]) . '" class="btn btn-outline btn-circle btn-sm purple" data-toggle="tooltip" title="Edit">'
                                    . '<i class="fa fa-edit"></i>'
                                    . '</a>'
                                    . '<a href="javascript:void(0);" onclick="deleteProduct(this);" data-href="' . Route("admin-deleteproduct", ['id' => $model->prod_ID]) . '" class="btn btn-outline btn-circle btn-sm dark" data-toggle="tooltip" title="Delete">'
                                    . '<i class="fa fa-trash"></i>'
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
            return view('admin::product.view', $data);
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
            return redirect()->route('admin-products');
        }
    }

    public function add_product() {
        $vendors = User::where('type_id', '3')->where('status', '1')->get();
        return view('admin::product.add', compact('vendors'));
    }

    public function post_add_product(AddProductRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $product_id = $this->store($request, NULL);
            $this->save_product_images($request, $product_id);
            $product = Product::where('prod_ID', $product_id)->first();
            $business = Business::where('bus_ID', $product->bus_ID)->first();

            $notification = [];
//            $notification['from_id'] = '1';
            $notification['notify_view_users'] = 'business';
            $notification['notifiers_id'] = $business->user_id;
            $notification['type'] = '6';
            $notification['notify_msg'] = 'Admin added a product to your business';
            $notification['status'] = '0';
            Notification::create($notification);
            $notification['notify_view_users'] = 'staff';
            $notification['notifiers_id'] = $business->hd_staff_link;
            $notification['type'] = '6';
            $notification['notify_msg'] = 'Admin added a product ';
            $notification['status'] = '0';
            Notification::create($notification);
            $notification['notify_view_users'] = 'admin';
            $notification['notifiers_id'] = '';
            $notification['type'] = '6';
            $notification['notify_msg'] = 'Admin added a product ';
            $notification['status'] = '0';
            Notification::create($notification);
            $data_msg['msg'] = "Product saved successfully.";
            $data_msg['link'] = route('admin-products');
            return response()->json($data_msg);
        }
    }

    public function get_update(Request $request, $id) {
        $data = [];
        $data['model'] = $model = Product::where('prod_ID', '=', $id)->findOrFail($id);
        $data['discounts'] = $discounts = Discount::where('id',$model->discount_id)->where('status','1')->first();
        if (count($model) > 0 && $model->status != '3') {
            $type = Business::select('prod_types')->where('bus_ID', $model->bus_ID)->first();
            $data['types'] = explode(",", $type->prod_types);
            return view('admin::product.update', $data);
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
            return redirect()->route('admin-products');
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
            $files = [];

            $data_msg = [];
            $targetDir = public_path('uploads/frontend/product/original/');
            $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
            $fileName = $this->rand_string(5) . time() . '.' . $ext;
            $targetFile = $targetDir . $fileName;
            move_uploaded_file($_FILES['file']['tmp_name'], $targetFile);
            $data_msg['file_name'] = $fileName;
            $data_msg['modelName'] = 'AllImages';
            if (Session::has('file')) {
                if ((count(Session::get('file'))) > 1) {
                    $files = Session::get('file');
                    $file = array_push($files, $fileName);
                    Session::put('file', $file);
                } else {
//                Session::push('file', $fileName);
                    $files = Session::get('file');
                    $file = array($files, $fileName);
                    Session::put('file', $file);
                }
            } else {
                Session::put('file', []);
                Session::put('file', $fileName);
            }


            return response()->json($data_msg);
        }
    }

    public function post_update(EditProductRequest $request, $id) {
        if ($request->ajax()) {
            $data_msg = [];
            $model = Product::findorFail($id);
            $product_id = $this->store($request, $model->prod_ID);
            $this->save_product_images($request, $product_id);
            $product = Product::where('prod_ID', $product_id)->first();
            $business = Business::where('bus_ID', $product->bus_ID)->first();
            $notification = [];
//            $notification['from_id'] = '1';
            $notification['notify_view_users'] = 'business';
            $notification['notifiers_id'] = $business->user_id;
            $notification['type'] = '6';
            $notification['notify_msg'] = 'Admin updated a product to your business';
            $notification['status'] = '0';
            Notification::create($notification);
            $notification['notify_view_users'] = 'staff';
            $notification['notifiers_id'] = $business->hd_staff_link;
            $notification['type'] = '6';
            $notification['notify_msg'] = 'Admin updated a product ';
            $notification['status'] = '0';
            Notification::create($notification);
            $notification['notify_view_users'] = 'admin';
            $notification['notifiers_id'] = '';
            $notification['type'] = '6';
            $notification['notify_msg'] = 'Admin updated a product ';
            $notification['status'] = '0';
            Notification::create($notification);
            $data_msg['msg'] = "Product saved successfully.";
            $data_msg['link'] = route('admin-products');
            return response()->json($data_msg);
        }
    }

    public static function save_product_images($request, $product_id) {
        if (!empty($request->input('AllImages')['image']) && !empty($product_id)) {
            $productImages = ProductImage::where(['prod_ID' => $product_id])->where('status', '1')->get();
            if (count($productImages) > 0) {
                foreach ($productImages as $img) {
                    if (file_exists(public_path('uploads/frontend/product/preview/' . $img->image_name))) {
                        $file1 = public_path('uploads/frontend/product/preview/' . $img->image_name);
                        unlink($file1);
                    }
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
            if (Session::has('file')) {
                for ($i = 0; $i <= (count(Session::get('file'))); $i++) {
                    $name = Session::get("file.$i");
                    if (file_exists(public_path('uploads/frontend/product/original/' . $name))) {
                        if (!(file_exists(public_path('uploads/frontend/product/preview/' . $name)))) {
                            $file1 = public_path('uploads/frontend/product/original/' . $name);
                            unlink($file1);
                        }
                    }
                }
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
        // print_r($input);
        // exit();
        $postage_cost = ($request->has('address_required') && $request->input('address_required') == 1) ? $request->input('postage_cost') : NULL;
        $input['postage_cost'] = $postage_cost;
        if ($checkProduct !== NULL) {
            $product = Product::where('prod_ID', $checkProduct)->where('status', '<>', '3')->first();
            $business = Business::where('bus_ID', $product->bus_ID)->first();

            if(!empty($business->commission_type)){
            
            if($business->commission_type == 1){
            $input['commission_type'] = $business->commission_type;
            $input['commission_rate'] = $business->commission_rate;
            $input['additional_rate'] = $business->additional_rate;  
            }
            elseif($business->commission_type == 2){
            $input['commission_type'] = $business->commission_type;
            $input['commission_rate'] = $request->input('commission_rate');
            $input['additional_rate'] = '0.00';    
            }
            }



            if ($request->input('price_verified_date') === NULL && $request->input('price_verified') == 1) {
                $input['price_verified_date'] = Carbon::now()->format('Y-m-d');
            } else if ($request->input('price_verified') == 2) {
                $input['price_verified_date'] = NULL;
            }
            if (($product->normal_price) != ($input['normal_price'])) {
                $discount_price = ($request->has('discount_price') && $request->input('discount_id') != '') ? $request->input('discount_price') : NULL;
                if($discount_price != NULL){
                    $normal_price = $discount_price; 
                }else{
                    $normal_price = $input['normal_price'];
                }
                $adverts = Advert::where('prod_ID', $checkProduct)->get();
                if (count($adverts) > 0) {
                    foreach ($adverts AS $advert) {
                        $commision_rate = $advert->commission_rate;
                        $additional_rate = $advert->additional_rate;
                        $cost_price = $this->get_cost_price($normal_price, $commision_rate, $additional_rate);
                        $hd_price = $this->get_HD_price($normal_price, $cost_price);
                        $advert->update(['cost_price' => $cost_price, 'hd_price' => $hd_price]);
                    }
                }
            }
            $product->update($input);
        } else {
            $input['prod_ID'] = $this->get_product_id();
            $input['price_verified'] = '2';
            $input['price_verified_date'] = NULL;
            $input['bus_ID'] = $request->input('vendor_id');

            $business = Business::where('bus_ID', $request->input('vendor_id'))->first();

            if(!empty($business->commission_type)){
            
            if($business->commission_type == 1){
            $input['commission_type'] = $business->commission_type;
            $input['commission_rate'] = $business->commission_rate;
            $input['additional_rate'] = $business->additional_rate;  
            }
            elseif($business->commission_type == 2){
            $input['commission_type'] = $business->commission_type;
            $input['commission_rate'] = '0.00';
            $input['additional_rate'] = '0.00';    
            }
            }

            $input['status'] = '1';
            $product = Product::create($input);
        }

        return $product->prod_ID;
    }

    public static function get_cost_price($normal_price, $commisionrate, $additonalrate) {
        $cost_price = $normal_price;
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

    public function delete(Request $request, $id) {
        $model = Product::where('prod_ID', '=', $id)->findOrFail($id);
        if (count($model) > 0 && $model->status != '3') {
            $model->update(['status' => '3']);
            $request->session()->flash('success', 'Product deleted successfully.');
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
        }
        return redirect()->route('admin-products');
    }
    public function get_subtype(Request $request) {
        if ($request->ajax()) {
            $data=[];
            $data_msg = [];
            $id=$request->input('id');
            $data['subtypes']=ProductSubType::where('parent_id',$id)->get();
            $data_msg['subtypes']=view('admin::product.subtypes',$data)->render();
            return response()->json($data_msg);
        }
    }
    public function get_type(Request $request) {
        if ($request->ajax()) {
            $data=[];
            $data_msg = [];
            $id=$request->input('id');
            $model = Business::select('prod_types')->where('bus_ID', $id)->first();
            $types = explode(",", $model->prod_types);
            $data['types']=$types;
            $data_msg['types']=view('admin::product.types',$data)->render();
            return response()->json($data_msg);
        }
    }

    public function get_discounted_price(Request $request){
        if($request->ajax()){
            $data=[];
            $discount_id = $request->input('discount_id');
            $normal_price = $request->input('normal_price');
            $discount_rate = Discount::select('discount_rate')->where('id',$discount_id)->first();
            $discount_price = $normal_price * (($discount_rate->discount_rate)/100);
            
            $discounted_price = $normal_price - $discount_price;
            $final_discounted_price = number_format($discounted_price,2);
            // echo ($final_discounted_price);
            // exit();
            $data['discounted_price'] = '<label for="usr">New Discounted Price</label><input type="number" class="form-control" name="discount_price" value="'.$final_discounted_price.'" readonly>';
            return response()->json($data);  
        }
    }

}
