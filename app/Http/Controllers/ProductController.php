<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
/* * ***************Requests******************* */
use App\Http\Requests\AddProductRequest;
use App\Http\Requests\EditProductRequest;
/* * ***************Models******************* */
use App\Product;
use App\ProductImage;
use App\Business;
use App\Notification;
use App\ProductSubType;
use App\Discount;

class ProductController extends Controller {

    public function get_product_list(Request $request) {
        if (Auth()->guard('frontend')->user()->type_id === '3') {
            $business_details = Business::select('*')->where('user_id', Auth()->guard('frontend')->user()->id)->first();
            $error = $this->check_business_details($business_details);
            
            if($error == 1){
            $request->session()->flash('error', 'You need to fill all the business details in order to add any poducts.');
            return redirect()->route('my-profile');
            }else{
             $products = Product::where('bus_ID', $business_details->bus_ID)->where('status', '<>', '3')->paginate(10);
            return view('product.listing', compact('products'));   
            }
        } else {
            abort(404);
        }
    }

    public function check_business_details($business_details){
         $error = '0';
         if(!empty($business_details)){
            if(empty($business_details->name)){
                $error = '1';
            }
            if(empty($business_details->address1)){
                $error = '1';
            }  
            if(empty($business_details->city)){
                $error = '1';
            } 
            if(empty($business_details->contact_no)){
                $error = '1';
            } 
            if(empty($business_details->post_code)){
                $error = '1';
            } 
            if(empty($business_details->halal_cert)){
                $error = '1';
            } 
            if(empty($business_details->alchohol_served)){
                $error = '1';
            } 
            if(empty($business_details->male_service)){
                $error = '1';
            } 
            if(empty($business_details->female_service)){
                $error = '1';
            } 
            if(empty($business_details->family_area)){
                $error = '1';
            } 
            if(empty($business_details->gender_segregated)){
                $error = '1';
            } 
            if(empty($business_details->introduction)){
                $error = '1';
            } 
            if(empty($business_details->details)){
                $error = '1';
            } 
            if(empty($business_details->smallprint)){
                $error = '1';
            } 
            if(empty($business_details->prod_types)){
                $error = '1';
            }
            return $error; 
        }
        return $error; 
    }

    public function get_add_product() {
        if (Auth()->guard('frontend')->user()->type_id === '3') {
            $data = Business::select('commission_type','prod_types')->where('user_id', Auth()->guard('frontend')->user()->id)->first();
            $types = explode(",", $data->prod_types);
            $discounts = Discount::where('status','1')->get();
            return view('product.add', compact('types','discounts','data'));
        } else {
            abort(404);
        }
    }

    public function post_add_product(AddProductRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $product_id = $this->store($request, NULL);
            $this->save_product_images($request, $product_id);
            $notification = [];
            $user_id = Auth::guard('frontend')->user()->id;
            $business = Business::where('user_id',$user_id )->first();
//            $notification['from_id'] = $user_id;
            $notification['notify_view_users'] = 'business';
            $notification['notifiers_id'] = $user_id;
            $notification['type'] = '6';
            $notification['notify_msg'] = 'New product added successfully ';
            $notification['status'] = '0';
            Notification::create($notification);
            $notification['notify_view_users'] = 'admin';
            $notification['notifiers_id'] = '';
            $notification['type'] = '6';
            $notification['notify_msg'] = 'New product added successfully ';
            $notification['status'] = '0';
            Notification::create($notification);
            $notification['notify_view_users'] = 'staff';
            $notification['notifiers_id'] = $business->hd_staff_link;
            $notification['type'] = '6';
            $notification['notify_msg'] = 'New product added successfully ';
            $notification['status'] = '0';
            Notification::create($notification);
            $data_msg['msg'] = "Product saved successfully.";
            $data_msg['link'] = route('get-product-list');
            return response()->json($data_msg);
        }
    }

    public function get_edit_product($id) {
        if (Auth()->guard('frontend')->user()->type_id === '3') {
            $model = Product::findorFail(base64_decode($id));
            $data = Business::select('prod_types')->where('user_id', Auth()->guard('frontend')->user()->id)->first();
            $types = explode(",", $data->prod_types);
            $discounts = Discount::where('status','1')->get();
            return view('product.edit', compact('model','types','discounts'));
        } else {
            abort(404);
        }
    }

    public function post_edit_product(EditProductRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $product = Product::findorFail($request->input('id'));
            $product_id = $this->store($request, $product->prod_ID);
            $this->save_product_images($request, $product_id);
             $notification = [];
            $user_id = Auth::guard('frontend')->user()->id;
            $business = Business::where('user_id',$user_id )->first();
//            $notification['from_id'] = $user_id;
            $notification['notify_view_users'] = 'business';
            $notification['notifiers_id'] = $user_id;
            $notification['type'] = '6';
            $notification['notify_msg'] = 'Product updated successfully ';
            $notification['status'] = '0';
            Notification::create($notification);
            $notification['notify_view_users'] = 'admin';
            $notification['notifiers_id'] = '';
            $notification['type'] = '6';
            $notification['notify_msg'] = 'Product updated successfully ';
            $notification['status'] = '0';
            Notification::create($notification);
            $notification['notify_view_users'] = 'staff';
            $notification['notifiers_id'] = $business->hd_staff_link;
            $notification['type'] = '6';
            $notification['notify_msg'] = 'Product updated successfully ';
            $notification['status'] = '0';
            Notification::create($notification);
            $data_msg['msg'] = "Product saved successfully.";
            $data_msg['link'] = route('get-product-list');
            return response()->json($data_msg);
        }
    }

    public function delete_product(Request $request) {
        if ($request->ajax()) {
            $data = [];
            $prod_id = $request->input('id');
            $checkProduct = Product::findorFail($prod_id);
            if (count($checkProduct) > 0) {
                $checkProduct->update(['status' => '3']);
                $data['status'] = 200;
                $data['msg'] = 'Product Deleted successfully.';
            } else {
                $data['msg'] = 'Opps! something went wrong.';
            }
            return response()->json($data);
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

    public static function save_product_images($request, $product_id) {
        if (!empty($request->input('AllImages')['image']) && !empty($product_id)) {
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
        if ($checkProductId !== 0) {
            return $this->get_product_id();
        } else {
            return $unique_id;
        }
    }

    public function store($request, $checkProduct = NULL) {
        $user_id = Auth()->guard('frontend')->user()->id;
        $business_details = Business::select('bus_ID','commission_type','commission_rate','additional_rate')->where('user_id', $user_id)->first();
        $input = $request->all();
        if($request->has('commission_type')){
            $input['additional_rate'] = $business_details->additional_rate;
        }else{
            $input['commission_type'] = $business_details->commission_type;
            $input['commission_rate'] = $business_details->commission_rate;
            $input['additional_rate'] = $business_details->additional_rate;
        }
        // print_r($input);
        // exit();
        $postage_cost = ($request->has('address_required') && $request->input('address_required') == 1) ? $request->input('postage_cost') : NULL;
        $discount_price = ($request->has('discount_price') && $request->input('discount_id') != '') ? $request->input('discount_price') : NULL;
        $input['postage_cost'] = $postage_cost;
        if ($checkProduct !== NULL) {
            $product = Product::where('prod_ID', $checkProduct)->where('bus_ID', $business_details->bus_ID)->where('status', '<>', '3')->first();
            if($discount_price != NULL){
                if ($product->discount_price != $discount_price) {
                $input['price_verified'] = '2';
                $input['price_verified_date'] = NULL;
            }
            }else{
                if ($product->normal_price != $request->input('normal_price')) {
                $input['price_verified'] = '2';
                $input['price_verified_date'] = NULL;
            }
            }
            $input['discount_price'] = $discount_price;
            $product->update($input);
        } else {
            $input['prod_ID'] = $this->get_product_id();
            $input['price_verified'] = '2';
            $input['price_verified_date'] = NULL;
            $input['bus_ID'] = $business_details->bus_ID;
            $input['status'] = '0';
            $product = Product::create($input);
        }
        return $product->prod_ID;
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
    public function get_subtype(Request $request) {
        if ($request->ajax()) {
            $data=[];
            $data_msg = [];
            $id=$request->input('id');
            $data['subtypes']=ProductSubType::where('parent_id',$id)->get();
            $data_msg['subtypes']=view('product.subtypes',$data)->render();
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
