<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
// ************ Requests ************
use Modules\Admin\Http\Requests\VendorRequest;
// ************ Mails ************
use Modules\Admin\Emails\CreateVendorMail;
// ************ Models ************
use App\User;
use App\Business;
use App\ProductType;
use App\Product;

class VendorController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = User::where('type_id', '=', '3')->get();
            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row) {
                                return '<a href="' . Route('vendor.show', ['id' => base64_encode($row->id)]) . '" class="btn btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <a href="' . Route('vendor.edit', ['id' => base64_encode($row->id)]) . '" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="javascript:;" data-id="' . base64_encode($row->id) . '" onclick="deleteVendor(this);" class="btn btn-outline btn-circle btn-sm dark">
                                        <i class="fa fa-trash"></i> Delete
                                    </a>';
                            })
                            ->editColumn('last_login_at', function($row) {
                                return date('jS M Y, g:i A', strtotime($row->last_login_at));
                            })
                            ->editColumn('created_at', function($row) {
                                return date('jS M Y, g:i A', strtotime($row->created_at));
                            })
                            ->editColumn('status', function($row) {
                                return ($row->status === '0') ? '<span class="label label-sm label-warning"> Inactive </span>' : (($row->status === '1') ? '<span class="label label-sm label-success"> Active </span>' : '<span class="label label-sm label-danger"> Block </span>');
                            })
                            ->rawColumns(['status', 'action'])
                            ->make(true);
        }
        return view('admin::vendor.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create() {
        $hd_staff = User::where('type_id', '2')->where('status', '1')->get();
        $product_types = ProductType::where('status', '1')->get();
        return view('admin::vendor.create', compact('product_types', 'hd_staff'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(VendorRequest $request) {
        $input = $request->all();
        // print_r($input);
        // exit();
        $business = [];
        $input['type_id'] = '3';
        $password = $this->rand_string(8);
        $input['password'] = Hash::make($password);
        $input['status'] = '1';
        $model = User::create($input);
        $business['bus_ID'] = $this->get_business_id();
        $business['user_id'] =  $model->id;
        if($request->commission_type == 1){
         $business['commission_type'] =  $request->input('commission_type');
         $business['commission_rate'] =  $request->input('commission_rate');
         $business['additional_rate'] =  $request->input('additional_rate');   
        }else{
         $business['commission_type'] =  $request->input('commission_type');
        }
        Business::create($business);
        $this->add_business($request, $model->id);
        $email_setting = $this->get_email_data('new_account_create_for_vendor', array('NAME' => $input['first_name'], 'EMAIL' => $input['email'], 'PASSWORD' => $password));
            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'create_vendor',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
        $request->session()->flash('success', 'Vendor created successfully.');
        return redirect()->route('vendor.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id) {
        $id = base64_decode($id);
        $model = User::findOrFail($id);
        $business = Business::where('user_id', $id)->first();
        return view('admin::vendor.view', compact('model', 'business'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id) {
        $id = base64_decode($id);
        $model = User::findOrFail($id);
        $business = Business::where('user_id', $id)->first();
        $hd_staff = User::where('type_id', '2')->where('status', '1')->get();
        $product_types = ProductType::where('status', '1')->get();
        return view('admin::vendor.update', compact('model', 'business', 'product_types', 'hd_staff'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(VendorRequest $request, $id) {
        $input = $request->all();
        $business_input=[];
        $id = base64_decode($id);
        $model = User::findOrFail($id);
        $this->add_business($request, $id);
        $business = Business::where('user_id', $id)->first();
        $commission_type = $request->input('commission_type');
        if($commission_type == 1){
         $business_input['commission_type'] =  $request->input('commission_type');
         $business_input['commission_rate'] =  $request->input('commission_rate');
         $business_input['additional_rate'] =  $request->input('additional_rate');   
        }else{
         $business['commission_type'] =  $request->input('commission_type');
         $business_input['commission_rate'] =  '0.00';
         $business_input['additional_rate'] =  '0.00'; 
        }
        $business->update($business_input);
        $products = Product::select('prod_ID','commission_type','commission_rate','additional_rate')->where('bus_ID',$business->bus_ID)->where('status','<>','3')->get();
        $update_product=[];
        if(sizeof($products) > 0){
            foreach ($products as $value) {
                $edit_product = Product::where('prod_ID',$value->prod_ID)->first();
                $update_product['commission_type'] = $business->commission_type;
                $update_product['commission_rate'] = $business->commission_rate;
                $update_product['additional_rate'] = $business->additional_rate;
                $edit_product->update($update_product);
            }
        }
        $model->update($input);
        $request->session()->flash('success', 'Vendor updated successfully.');
        return redirect()->route('vendor.edit', ['id' => base64_encode($id)])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id) {
        $id = base64_decode($id);
        User::findOrFail($id)->delete();
        Session::flash('success', "Vendor deleted successfully.");
        return redirect()->route('vendor.index');
    }

    public static function add_business($request, $id) {
        $business = Business::where('user_id', $id)->first();
        $input = $request->all();
        if ($request->has('prod_types')) {
            $input['prod_types'] = implode(",", $request->input('prod_types'));
        }
        if ($request->has('prod_sub_types')) {
            $input['prod_sub_types'] = implode(",", $request->input('prod_sub_types'));
        }
        $business->update($input);
    }
        public function get_business_id() {
        $unique_id ="B".$this->rand_string(5);
        $checkBusId = Business::where('bus_ID', $unique_id)->count();
        if ($checkBusId !== 0) {
            return $this->get_business_id();
        } else {
            return $unique_id;
        }
    }

}
