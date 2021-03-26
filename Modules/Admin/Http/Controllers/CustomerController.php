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
use Modules\Admin\Http\Requests\CustomerRequest;
// ************ Mails ************
use Modules\Admin\Emails\CreateCustomerMail;
// ************ Models ************
use App\User;
use App\Country;

class CustomerController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = User::where('type_id', '=', '4')->get();
            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row) {
                                return '<a href="' . Route('customer.show', ['id' => base64_encode($row->id)]) . '" class="btn btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <a href="' . Route('customer.edit', ['id' => base64_encode($row->id)]) . '" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="javascript:;" data-id="' . base64_encode($row->id) . '" onclick="deleteCustomer(this);" class="btn btn-outline btn-circle btn-sm dark">
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
        return view('admin::customer.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create() {
        return view('admin::customer.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(CustomerRequest $request) {
        $input = $request->all();
        $input['type_id'] = '4';
        $password = $this->rand_string(8);
        $input['password'] = Hash::make($password);
        $input['status'] = '1';
        $model = User::create($input);
//        Mail::to($model->email)->send(new CreateCustomerMail($model, $password));
        $email_setting = $this->get_email_data('new_account_create_for_customer', array('NAME' => $input['first_name'], 'EMAIL' => $input['email'], 'PASSWORD' => $password));
            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'create_customer',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
        $request->session()->flash('success', 'Customer created successfully.');
        return redirect()->route('customer.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id) {
        $id = base64_decode($id);
        $model = User::findOrFail($id);
        $country_name = Country::select('name')->where('id',$model->country)->where('status','1')->first();
        return view('admin::customer.view', compact('model','country_name'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id) {
        $id = base64_decode($id);
        $model = User::findOrFail($id);
        return view('admin::customer.update', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(CustomerRequest $request, $id) {
        $input = $request->all();
        $id = base64_decode($id);
        $model = User::findOrFail($id);
        $model->update($input);
        $request->session()->flash('success', 'Customer updated successfully.');
        return redirect()->route('customer.edit', ['id' => base64_encode($id)])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id) {
        $id = base64_decode($id);
        User::findOrFail($id)->delete();
        Session::flash('success', "Customer deleted successfully.");
        return redirect()->route('customer.index');
    }

}
