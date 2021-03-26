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
use Illuminate\Support\Facades\Session;

/* * *************** Model ************ */
use App\Notification;

class NotificationController extends StaffController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        $user_id = Auth::guard('staff')->user()->id;
        $data['allcount'] = Notification::where('notify_view_users', '=', 'staff')->where('notifiers_id', '=', $user_id)->where('status', '<>', '3')->count();
        $rowperpage = 15;
        $data['models'] = Notification::where('notify_view_users', '=', 'staff')->where('notifiers_id', '=', $user_id)->where('status', '<>', '3')->orderBy('id', 'DESC')->skip(0)->take($rowperpage)->get();
        return view('staff::notification.index', $data);
    }

    public function changenotistatus(Request $request) {
        $id = $request->input('id');
        $model = Notification::findorFail($id);
        if (count($model) > 0) {
            $model->update(['status' => '1']);
        }
        $data['value']='success';
        return response()->json($data);
    }

    public function load_notification(Request $request) {
        $row = $request->input('row');
        $rowperpage = 15;
        $user_id = Auth::guard('staff')->user()->id;
        $models = Notification::where('notify_view_users', '=', 'staff')->where('status', '<>', '3')->orderBy('id', 'DESC')->skip($row)->take($rowperpage)->get();
        $html = '';


        foreach ($models as $model) {
            $html .= '<div class="success alert-success text-center" role="success">';
            if ($model->type == '6') {
                $html .= '<li>';
                $html .= '<a href="javascript:void(0);"  data-location="' . Route("admin-products") . '"  onclick="changenotistatus(' . $model->id . ',this);">';
                $html .= '<span class="details">';
                $html .= '<span class="label label-sm label-icon label-success">';
                $html .= '<i class="icon-equalizer"></i>';
                if ($model->status == '1') {
                    $html .= '<span>' . $model->notify_msg . '</span>';
                } else {
                    $html .= '<span><b>' . $model->notify_msg . '</b></span>';
                }
                $html .= '</span>';
                $html .= '</span>';
                $html .= '<a/>';
                $html .= '<br/>';
                $html .= '<span class="time">' . \Carbon\Carbon::parse($model->created_at)->format('d F ') . '</span>';
                $html .= '</li>';
            } elseif ($model->type == '7') {
                $html .= '<li>';
                $html .= '<a href="javascript:void(0);"  data-location="' . Route("staff-deal-adverts") . '"  onclick="changenotistatus(' . $model->id . ',this);">';
                $html .= '<span class="details">';
                $html .= '<span class="label label-sm label-icon label-success">';
                $html .= '<i class="icon-equalizer"></i>';
                if ($model->status == '1') {
                    $html .= '<span>' . $model->notify_msg . '</span>';
                } else {
                    $html .= '<span><b>' . $model->notify_msg . '</b></span>';
                }
                $html .= '</span>';
                $html .= '</span>';
                $html .= '<a/>';
                $html .= '<br/>';
                $html .= '<span class="time">' . \Carbon\Carbon::parse($model->created_at)->format('d F ') . '</span>';
                $html .= '</li>';
            }
            elseif ($model->type == '8') {
                $html .= '<li>';
                $html .= '<a href="javascript:void(0);"  data-location="' . Route("staff-voucher-adverts") . '"  onclick="changenotistatus(' . $model->id . ',this);">';
                $html .= '<span class="details">';
                $html .= '<span class="label label-sm label-icon label-success">';
                $html .= '<i class="icon-equalizer"></i>';
                if ($model->status == '1') {
                    $html .= '<span>' . $model->notify_msg . '</span>';
                } else {
                    $html .= '<span><b>' . $model->notify_msg . '</b></span>';
                }
                $html .= '</span>';
                $html .= '</span>';
                $html .= '<a/>';
                $html .= '<br/>';
                $html .= '<span class="time">' . \Carbon\Carbon::parse($model->created_at)->format('d F ') . '</span>';
                $html .= '</li>';
            }
            $html .= '<hr>';
            $html .= '</div>';
        }
        $data['html'] = $html;
        return response()->json($data);
    }
}
