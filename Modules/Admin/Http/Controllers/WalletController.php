<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\ImageManagerStatic as Image;
use URL;
//use Carbon\Carbon;
use Illuminate\Support\Facades\Session;

/* * *************** Model ************ */
use App\Business;
use App\User;
use App\Wallet;
use App\Notification;

class WalletController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        return view('admin::wallet.index');
    }

    public function get_withdrawl_list_datatable() {
        $withdrawl_list = Wallet::select('wallet.*', 'users.first_name', 'users.last_name')
                ->leftJoin('users', 'users.id', '=', 'wallet.user_id');



        return Datatables::of($withdrawl_list)
                        ->addIndexColumn()
                        ->editColumn('users.first_name', function ($model) {

                            return $model->first_name . ' ' . $model->last_name;
                        })
                        ->editColumn('amount', function ($model) {
                            return $model->amount;
                        })
                        ->editColumn('created_at', function ($model) {
                            return (!empty($model->created_at)) ? \Carbon\Carbon::parse($model->created_at)->format('d F Y') : 'Not Applicable';
                        })
                        ->editColumn('status', function ($model) {
                            if ($model->status === '0') {
                                $status = '<span class="label label-sm label-warning">Pending</span>';
                            } else {
                                $status = '<span class="label label-sm label-success">Paid</span>';
                            }
                            return $status;
                        })
                        ->addColumn('action', function ($model) {
                            $action_html = '<a href="' . Route('admin-withdrawlrequestdetail', ['ID' => $model->id]) . '" class="btn btn-outline btn-circle btn-sm blue" data-toggle="tooltip" title="View">'
                                    . '<i class="fa fa-eye"></i>'
                                    . '</a>';
                            return $action_html;
                        })
                        ->rawColumns(['status', 'action'])
                        ->make(true);
    }

    public function show($id) {

        $data['wallet'] = $wallet = Wallet::where('id', $id)->first();
        $data['user'] = User::where('id', $wallet->user_id)->first();
        return view('admin::wallet.view', $data);
    }

    public function add_payment($id) {
        $input['status'] = '1';
        $wallet = wallet::where('id', $id)->first();
        $user = User::where('id', $wallet->user_id)->first();
        $wallet->update($input);
        $email_setting = $this->get_email_data('payment', array('NAME' => $user->first_name . ' ' . $user->last_name, 'AMOUNT' => $wallet->amount));
        $email_data = [
            'to' => $user->email,
            'subject' => $email_setting['subject'],
            'template' => 'payment',
            'data' => ['message' => $email_setting['body']]
        ];
        $this->SendMail($email_data);
        $business = Business::where('user_id', $wallet->user_id)->first();
        $balance['wallet_amount'] = ($business->wallet_amount) - ($wallet->amount);
        $business->update($balance);
        $notification = [];
        $notification['notify_view_users'] = 'business';
        $notification['notifiers_id'] = $wallet->user_id;
        $notification['type'] = '9';
        $notification['notify_msg'] = 'Congratulations!! Your withdrawl amount $' . $wallet->amount . ' credited shortly in you given bank account.';
        $notification['status'] = '0';
        Notification::create($notification);
        return \Redirect::Route('admin-wallet-management')->with('success', 'Payment successfull ');
    }

}
