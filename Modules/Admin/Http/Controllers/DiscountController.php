<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Yajra\DataTables\Facades\DataTables;
// ************ Requests ************
use Modules\Admin\Http\Requests\CreateDiscountRequest;
use Modules\Admin\Http\Requests\UpdateDiscountRequest;
// ************ Mails ************
// ************ Models ************
use App\Discount;

class DiscountController extends AdminController {

    public function index(Request $request) {
        if ($request->ajax()) {
            $data = Discount::where('status', '<>', '3');
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row) {
                                return '<a href="' . Route('admin-discount-view', [base64_encode($row->id)]) . '" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-eye"></i> View
                                    </a>
                                    <a href="' . Route('admin-discount-edit', [base64_encode($row->id)]) . '" class="btn btn-outline btn-circle btn-sm purple">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>';
                            })
                            ->editColumn('name', function($row) {
                                return $row->name;
                            })
                            ->editColumn('discount_rate', function($row) {
                                return $row->discount_rate;
                            })
                            ->editColumn('updated_at', function($row) {
                                return date('jS M Y, g:i A', strtotime($row->updated_at));
                            })
                            ->editColumn('status', function($row) {
                                return ($row->status === '0') ? '<span class="label label-sm label-warning"> Inactive </span>' : (($row->status === '1') ? '<span class="label label-sm label-success"> Active </span>' : '<span class="label label-sm label-danger"> Block </span>');
                            })
                            ->rawColumns(['status', 'action'])
                            ->make(true);
        }
        return view('admin::discount.index');
    }

    // public function get_create() {
    //     $data = [];
    //     return view('admin::category.create', $data);
    // }

    // public function post_create(CreateDiscountRequest $request) {
    //     if ($request->ajax()) {
    //         $data_msg = [];
    //         $input = $request->all();
    //         $input['status'] = '1';
    //         Category::create($input);
    //         $data_msg['msg'] = 'Category Created Sucessfully';
    //         $data_msg['link'] = route('admin-model-category');
    //         return response()->json($data_msg);
    //     }
    // }

    public function get_edit($id) {
        $id = base64_decode($id);
        $model = Discount::where('id', $id)->where('status', '<>', '3')->first();
        if (!empty($model)) {
            return view('admin::discount.update', compact('model'));
        }
        return redirect()->back()->with('error', 'No model details found.');
    }

    public function post_edit(UpdateDiscountRequest $request, $id) {
        if ($request->ajax()) {
            $data_msg = [];
            $id = base64_decode($id);
            $model = Discount::where('id', $id)->first();
            $input = $request->input();
            // print_r($input);
            // exit();
            $model->update($input);
            $data_msg['msg'] = 'Discount updated successfully.';
            $data_msg['link'] = route('admin-discount');
            return response()->json($data_msg);
        }
    }

    public function view($id) {
        $id = base64_decode($id);
        $model = Discount::where('id', $id)->where('status', '<>', '3')->first();
        if (!empty($model)) {
            return view('admin::discount.view', compact('model'));
        }
        return redirect()->back()->with('error', 'No model details found.');
    }

    // public function delete($id) {
    //     $data = [];
    //     $cid = base64_decode($id);
    //     $model = Category::where('id', $cid)->where('status', '<>', '3')->first();
    //     if (!empty($model)) {
    //         $model->update(['status' => '3']);
    //         $data['msg'] = 'Category deleted successfully.';
    //         $data['status'] = 200;
    //     } else {
    //         $data['msg'] = 'Category details not found.';
    //     }
    //     return response()->json($data);
    // }

}
