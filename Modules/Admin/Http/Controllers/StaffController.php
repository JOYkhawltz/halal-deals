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
use Modules\Admin\Http\Requests\StaffRequest;
// ************ Mails ************
use Modules\Admin\Emails\CreateStaffMail;
// ************ Models ************
use App\User;
use App\ProductType;

class StaffController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $data = User::where('type_id', '=', '2')->get();
            return Datatables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row) {
                                return '<a href="' . Route('admin-staff.show', ['id' => base64_encode($row->id)]) . '" class="btn btn-outline btn-circle btn-sm blue">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <a href="' . Route('admin-staff.edit', ['id' => base64_encode($row->id)]) . '" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>
                                    <a href="javascript:;" data-id="' . base64_encode($row->id) . '" onclick="deleteAdminStaff(this);" class="btn btn-outline btn-circle btn-sm dark">
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
        return view('admin::staff.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create() {
        return view('admin::staff.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(StaffRequest $request) {
        $input = $request->all();
        $input['type_id'] = '2';
        $password = $this->rand_string(8);
        $url=url("/staff");
        $input['password'] = Hash::make($password);
        $input['status'] = '1';
        $model = User::create($input);
        $email_setting = $this->get_email_data('new_account_create_for_hdstaff', array('NAME' => $input['first_name'], 'EMAIL' => $input['email'], 'PASSWORD' => $password,'URL'=>$url));
        // print_r($email_setting);
        // exit();
            $email_data = [
                'to' => $input['email'],
                'subject' => $email_setting['subject'],
                'template' => 'create_staff',
                'data' => ['message' => $email_setting['body']]
            ];
        // print_r($email_data);
        // exit();
            $this->SendMail($email_data);
        $request->session()->flash('success', 'Staff created successfully.');
        return redirect()->route('admin-staff.index');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id) {
        $id = base64_decode($id);
        $model = User::findOrFail($id);
        return view('admin::staff.view', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id) {
        $id = base64_decode($id);
        $model = User::findOrFail($id);
        return view('admin::staff.update', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(StaffRequest $request, $id) {
        $input = $request->all();
        $id = base64_decode($id);
        $model = User::findOrFail($id);
        $model->update($input);
        $request->session()->flash('success', 'Staff updated successfully.');
        return redirect()->route('admin-staff.edit', ['id' => base64_encode($id)])->withInput();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id) {
        $id = base64_decode($id);
        User::findOrFail($id)->delete();
        Session::flash('success', "Staff deleted successfully.");
        return redirect()->route('admin-staff.index');
    }

}
