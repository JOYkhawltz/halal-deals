<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Mail;
use App\Email;
class AdminController extends Controller {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function rand_string($digits) {
        $alphanum = Str::random(40) . Carbon::now()->timestamp;
        $rand = Str::limit(str_shuffle($alphanum), $digits, '');
        return $rand;
    }

    public function SendMail($data) {
        
        $template = view('admin::mail.layouts.template')->render();
        // print_r($template);
        // exit();
        $content = view('admin::mail.' . $data['template'], $data['data'])->render();
        $view = str_replace('[[email_message]]', $content, $template);
        $data['content'] = $view;
        // print_r($view);
        // exit();
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

//     public function SendMail($data) {
//         $template = view('mail.layouts.template')->render();
//         $content = view('mail.' . $data['template'], $data['data'])->render();
//         $view = str_replace('[[email_message]]', $content, $template);
//         $data['content'] = $view;
// //        $headers = "MIME-Version: 1.0" . "\r\n";
// //        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
// //        $headers .= 'From: admin@laravel.com' . "\r\n" .
// //                'Reply-To: no-reply@laravel.com' . "\r\n" .
// //                'X-Mailer: PHP/' . phpversion();
// //        $va = str_replace('[[email_message]]', $content, $template);
// //        return mail($data['to'], $data['subject'], $va, $headers);
//         Mail::send([], [], function ($message) use ($data) {
//             $message->from('admin@laravel.com', env('APP_NAME', 'Laravel'));
//             $message->replyTo('no-reply@laravel.com', env('APP_NAME', 'Laravel'));
//             $message->subject($data['subject']);
//             $message->setBody($data['content'], 'text/html');
//             $message->to($data['to']);
//         });
//     }

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
