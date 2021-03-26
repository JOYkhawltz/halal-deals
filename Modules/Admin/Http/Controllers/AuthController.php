<?php

namespace Modules\Admin\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
// ************ Requests ************
use Modules\Admin\Http\Requests\LoginRequest;
use Modules\Admin\Http\Requests\ForgotRequest;
use Modules\Admin\Http\Requests\LockRequest;
// ************ Mails ************
use Modules\Admin\Emails\ForgotPasswordMail;
// ************ Models ************
use App\User;

class AuthController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function get_login() {
        return view('admin::auth.login');
    }

    public function post_login(LoginRequest $request) {
        $model = User::where('email', '=', $request->input('email'))->where('type_id', '=', '1')->first();
        if (count($model) === 1 && Hash::check($request->input('password'), $model->password)) {
            if ($request->input('rememberMe') !== NULL) {
                $expire = time() + 3600;
                setcookie('admin_email', $request->input('email'), $expire);
                setcookie('admin_password', $request->input('password'), $expire);
            } else {
                $expire = time() - 3600;
                setcookie('admin_email', '', $expire);
                setcookie('admin_password', '', $expire);
            }
            Auth::guard('backend')->login($model);
            $model->last_login_at = Carbon::now()->toDateTimeString();
            $model->save();
            return redirect()->route('admin-dashboard')->with('success', 'You are successfully logged in.');
        } else {
            return redirect()->back()->with('danger', 'Incorrect Email or Password!');
        }
    }

    public function logout() {
        if (isset($_GET['type']) && $_GET['type'] === "lock") {
            $user = Auth::guard('backend')->user();
            $expire = time() + 3600;
            setcookie('admin_email_lock', $user->email, $expire);
            Auth::guard('backend')->logout();
            return redirect('admin/lockscreen');
        } else {
            Auth::guard('backend')->logout();
            return redirect('admin/login')->with('success', 'You are successfully logged out.');
        }
    }

    public function post_forgot_password(ForgotRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $password = $this->rand_string(8);
            $input = $request->all();
            $input['password'] = Hash::make($password);
            $model = User::where('type_id', '=', '1')->where('email', '=', $request->input('email'))->first();
            $model->update($input);
//                $email_setting = $this->get_email_data('admin_forgot_password', array('NAME' => $name, 'NEW_PASSWORD' => $password));
//                $email_data = [
//                    'to' => $model->email,
//                    'subject' => $email_setting['subject'],
//                    'template' => 'admin_forgot_password',
//                    'data' => ['message' => $email_setting['body']]
//                ];
//                $this->SendMail($email_data);
            Mail::to($model->email)->send(new ForgotPasswordMail($model, $password));
            $request->session()->flash('success', 'We have sent a new password to your email. Please check it.');
            return response()->json($data_msg);
        }
    }

    public function get_lockscreen() {
        if (!Auth::guard('backend')->guest()) {
            return redirect('admin/dashboard');
        }
        if (isset($_COOKIE['admin_email_lock']) && $_COOKIE['admin_email_lock'] !== NULL) {
            $model = User::where('type_id', '=', '1')->where('email', '=', $_COOKIE['admin_email_lock'])->first();
            return view('admin::auth.lock_screen', compact('model'));
        } else {
            return redirect('admin/login');
        }
    }

    public function post_lockscreen(LockRequest $request) {
        $model = User::where('type_id', '=', '1')->where('email', '=', $_COOKIE['admin_email_lock'])->first();
        Auth::guard('backend')->login($model);
        $expire = time() - 3600;
        setcookie('admin_email_lock', '', $expire);
        return redirect('admin/dashboard')->with('success', 'You are successfully unlocked.');
    }

}
