<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\ImageManagerStatic as Image;
use URL;
//use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

/* * *************** Model ************ */
use App\Notification;
use App\OrderDetails;
use App\OrderMaster;
use App\User;
use App\Advert;
use App\Country;

class OrderController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        return view('admin::order.index');
    }

    public function get_order_list_datatable() {
        $advert_list = OrderMaster::select('order_master.*', 'users.first_name', 'users.last_name')
                ->leftJoin('users', 'users.id', '=', 'order_master.user_id')
                ->where('order_master.status', '=', 'completed');


        return Datatables::of($advert_list)
                        ->editColumn('id', function ($model) {
                            return $model->id;
                        })
                         ->editColumn('order_number', function ($model) {
                            return $model->order_number;
                        })
                        ->editColumn('users.first_name', function ($model) {

                            return $model->first_name . ' ' . $model->last_name;
                        })
                        ->editColumn('payment_gateway', function ($model) {
                            return $model->payment_gateway ;
                        })
                        ->editColumn('pay_amount', function ($model) {
                            return $model->pay_amount;
                        })
                        ->editColumn('status', function ($model) {
                            if ($model->status === 'pending') {
                                    $status = '<span class="label label-sm label-warning">Pending</span>';
                                } else if ($model->status === 'processing') {
                                    $status = '<span class="label label-sm label-info">Processing</span>';
                                } else if ($model->status === 'completed') {
                                    $status = '<span class="label label-sm label-success">Success</span>';
                                } else if ($model->status === 'decline') {
                                    $status = '<span class="label label-sm label-danger">Decline</span>';
                                } else {
                                    $status = '<span class="label label-sm label-danger">Cancel</span>';
                                }
                                return $status;
                            })
                        ->addColumn('action', function ($model) {
                            $action_html = '<a href="' . Route('admin-orderlistdetail', ['ID' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm blue" data-toggle="tooltip" title="View">'
                                    . '<i class="fa fa-eye"></i>'
                                    . '</a>';
                            return $action_html;
                        })
                        ->rawColumns(['status', 'action'])
                        ->make(true);
    }
    public function get_order_details_datatable($o_id) {
        $advert_list = OrderDetails::select('order_details.*','adverts.title')
                ->leftJoin('adverts', 'adverts.advert_ID', '=', 'order_details.advert_id')
                ->where('order_details.order_id',$o_id);


        return Datatables::of($advert_list)
                        ->addIndexColumn()
                        ->editColumn('type', function ($model) {
                            return $model->type;
                        })
                        ->editColumn('title', function ($model) {
                            
                            return $model->title;
                        })
                        ->editColumn('item_price', function ($model) {
                            return $model->item_price*$model->quantity;
                        })
                        ->editColumn('quantity', function ($model) {
                            return $model->quantity;
                        })
                        ->editColumn('status', function ($model) {
                            if ($model->status === '0') {
                                    $status = '<span class="label label-sm label-warning">Processing</span>';
                                } else if ($model->status === '1') {
                                    $status = '<span class="label label-sm label-info">Order Placed</span>';
                                } else if ($model->status === '2') {
                                    $status = '<span class="label label-sm label-success">Shipped</span>';
                                }else if ($model->status === '3') {
                                    $status = '<span class="label label-sm label-success">Delivered</span>';
                                } else if ($model->status === '4') {
                                    $status = '<span class="label label-sm label-danger">Canceled</span>';
                                } else {
                                    $status = '<span class="label label-sm label-danger">Cancel</span>';
                                }
                                return $status;
                            })
                        ->addColumn('action', function ($model) {
                            $action_html = '<a href="' . Route('admin-vieworderdetail', ['ID' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm blue" data-toggle="tooltip" title="View">'
                                    . '<i class="fa fa-eye"></i>'
                                    . '</a>';
                            return $action_html;
                        })
                        ->rawColumns(['status', 'action'])
                        ->make(true);
    }

    public function order_details($id) {
        $data = [];
        $data['id'] = $id;
        return view('admin::order.order_details', $data);
    }
    public function show($id) {
        $data = [];
        $data['model'] = $model = OrderDetails::findOrFail($id);
        $data['address']=$address= OrderMaster::where('id',$model->order_id)->first();
        $data['country']= Country::where('id',$address->country)->first();
        return view('admin::order.view', $data);
    }

}
