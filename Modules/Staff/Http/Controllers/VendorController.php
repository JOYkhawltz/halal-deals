<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
// ************ Requests ************
use Modules\Staff\Http\Requests\VendorRequest;
// ************ Mails ************
use Modules\Staff\Emails\CreateVendorMail;
// ************ Models ************
use App\User;
use App\Business;
use App\ProductType;

class VendorController extends StaffController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $user_id = Auth()->guard('staff')->user()->id;
            $data = User::select('users.*')->leftJoin('businesses', 'businesses.user_id', '=', 'users.id')->where('businesses.hd_staff_link', $user_id)->where('users.type_id', '=', '3')->get();
            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row) {
                                return '<a href="' . Route('staff-vendor.show', ['id' => base64_encode($row->id)]) . '" class="btn btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <a href="' . Route('staff-vendor.edit', ['id' => base64_encode($row->id)]) . '" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>';
                            })
                            ->editColumn('users.last_login_at', function($row) {
                                return date('jS M Y, g:i A', strtotime($row->last_login_at));
                            })
                            ->editColumn('users.created_at', function($row) {
                                return date('jS M Y, g:i A', strtotime($row->created_at));
                            })
                            ->editColumn('status', function($row) {
                                return ($row->status === '0') ? '<span class="label label-sm label-warning"> Inactive </span>' : (($row->status === '1') ? '<span class="label label-sm label-success"> Active </span>' : '<span class="label label-sm label-danger"> Block </span>');
                            })
                            ->rawColumns(['status', 'action'])
                            ->make(true);
        }
        return view('staff::vendor.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
//    public function create() {
//        $hd_staff = User::where('type_id', '2')->where('status', '1')->get();
//        $product_types = ProductType::where('status', '1')->get();
//        return view('staff::vendor.create', compact('product_types', 'hd_staff'));
//    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
//    public function store(VendorRequest $request) {
//        $input = $request->all();
//        $input['type_id'] = '3';
//        $password = $this->rand_string(8);
//        $input['password'] = Hash::make($password);
//        $input['status'] = '1';
//        $model = User::create($input);
//        Business::create(['user_id' => $model->id]);
//        $this->add_business($request, $model->id);
//        Mail::to($model->email)->send(new CreateVendorMail($model, $password));
//        $request->session()->flash('success', 'Vendor created successfully.');
//        return redirect()->route('vendor.index');
//    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id) {
        $id = base64_decode($id);
        $model = User::findOrFail($id);
        $business = Business::where('user_id', $id)->first();
        return view('staff::vendor.view', compact('model', 'business'));
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
        return view('staff::vendor.update', compact('model', 'business', 'product_types', 'hd_staff'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(VendorRequest $request, $id) {
        $input = $request->all();
        $id = base64_decode($id);
        $model = User::findOrFail($id);
        $this->add_business($request, $id);
        $model->update($input);
        $request->session()->flash('success', 'Vendor updated successfully.');
        return redirect()->route('staff-vendor.edit', ['id' => base64_encode($id)])->withInput();
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
        return redirect()->route('staff-vendor.index');
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

}
