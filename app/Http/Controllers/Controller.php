<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use MetaTag;
use App\Seo;
use Mail;
use App\Email;
use App\OrderDetails;
use App\OrderMaster;
use App\User;
use App\VoucherDetail;
use App\Business;
class Controller extends BaseController {

    use AuthorizesRequests,
        DispatchesJobs,
        ValidatesRequests;

    public function __construct(Request $request) {
        if (!$request->ajax()) {
            $route = Route::currentRouteName();
            $seo = Seo::where(['route' => $route])->first();
            if (count($seo) === 0) {
                $seo = new Seo;
                $seo->route = $route;
                $seo->save();
            }
            if ($seo !== NULL) {
                MetaTag::set('title', $seo->title);
                MetaTag::set('keyword', $seo->keyword);
                MetaTag::set('description', $seo->description);
//                MetaTag::set('image', asset('images/locked-logo.png'));
            }
        }
    }

    public function rand_string($digits) {
        $alphanum = Str::random(40) . Carbon::now()->timestamp;
        $rand = Str::limit(str_shuffle($alphanum), $digits, '');
        return $rand;
    }

    public function SendMail($data) {
        $template = view('mail.layouts.template')->render();
        $content = view('mail.' . $data['template'], $data['data'])->render();
        $view = str_replace('[[email_message]]', $content, $template);
        $data['content'] = $view;
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        $headers .= 'From: admin@laravel.com' . "\r\n" .
//                'Reply-To: no-reply@laravel.com' . "\r\n" .
//                'X-Mailer: PHP/' . phpversion();
//        $va = str_replace('[[email_message]]', $content, $template);
//        return mail($data['to'], $data['subject'], $va, $headers);
        Mail::send([], [], function ($message) use ($data) {
            $message->from('admin@laravel.com', env('APP_NAME', 'Laravel'));
            $message->replyTo('no-reply@laravel.com', env('APP_NAME', 'Laravel'));
            $message->subject($data['subject']);
            $message->setBody($data['content'], 'text/html');
            $message->to($data['to']);
        });
    }

    public function SendMail2_to_business($data){
        $model['order']=$order=OrderMaster::findOrFail($data['data']);
        $model['deal_details']=OrderDetails::select('order_details.*','adverts.title','adverts.prod_ID')
        ->leftjoin('adverts','adverts.advert_ID','order_details.advert_id')->where('order_details.order_id',$order->id)->where('order_details.bus_ID',$data['bus_ID'])->where('order_details.type','deal')->get();
        $model['bus_ID']=$data['bus_ID'];
        $model['user']=User::where("id",$order->user_id)->first();
        $model['business']=User::select('users.*')
        ->leftjoin('businesses','businesses.user_id','users.id')->where('businesses.bus_ID',$data['bus_ID'])->first();
        $view = view('mail.' . $data['template'], $model)->render();
        // $view = str_replace('[[email_message]]', $content, $template);
        $data['content'] = $view;
        
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        $headers .= 'From: admin@laravel.com' . "\r\n" .
//                'Reply-To: no-reply@laravel.com' . "\r\n" .
//                'X-Mailer: PHP/' . phpversion();
//        $va = str_replace('[[email_message]]', $content, $template);
//        return mail($data['to'], $data['subject'], $va, $headers);
        Mail::send([], [], function ($message) use ($data) {
            $message->from('admin@laravel.com', env('APP_NAME', 'Laravel'));
            $message->replyTo('no-reply@laravel.com', env('APP_NAME', 'Laravel'));
            $message->subject($data['subject']);
            $message->setBody($data['content'], 'text/html');
            $message->to($data['to']);
        });
    }

    public function SendMail2_to_customer($data) {
        // $template = view('mail.layouts.template')->render();
        $model['order']=$order=OrderMaster::findOrFail($data['data']);
        $model['deal_details']=OrderDetails::select('order_details.*','adverts.title','adverts.prod_ID')
        ->leftjoin('adverts','adverts.advert_ID','order_details.advert_id')->where('order_details.order_id',$order->id)->where('order_details.type','deal')->get();
        $model['order_details']=OrderDetails::where('order_id',$order->id)->where('type','voucher')->get();
        $model['user']=User::where("id",$order->user_id)->first();
        // print_r($model);die();
        $view = view('mail.' . $data['template'], $model)->render();
        // $view = str_replace('[[email_message]]', $content, $template);
        $data['content'] = $view;
//        $headers = "MIME-Version: 1.0" . "\r\n";
//        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//        $headers .= 'From: admin@laravel.com' . "\r\n" .
//                'Reply-To: no-reply@laravel.com' . "\r\n" .
//                'X-Mailer: PHP/' . phpversion();
//        $va = str_replace('[[email_message]]', $content, $template);
//        return mail($data['to'], $data['subject'], $va, $headers);
        Mail::send([], [], function ($message) use ($data) {
            $message->from('admin@laravel.com', env('APP_NAME', 'Laravel'));
            $message->replyTo('no-reply@laravel.com', env('APP_NAME', 'Laravel'));
            $message->subject($data['subject']);
            $message->setBody($data['content'], 'text/html');
            $message->to($data['to']);
        });
    }

    public function get_email_data($slug, $replacedata = array()) {
        $email_data = Email::where(['slug' => $slug])->first();
        $email_msg = "";
        $email_array = array();
        $email_msg = $email_data->body;
        $subject = $email_data->subject;
        if (!empty($replacedata)) {
            foreach ($replacedata as $key => $value) {
                $email_msg = str_replace("{{" . $key . "}}", $value, $email_msg);
            }
        }
        return array('body' => $email_msg, 'subject' => $subject);
    }

}
