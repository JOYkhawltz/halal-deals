<?php

namespace Modules\Staff\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
// ************ Requests ************
use Modules\Staff\Http\Requests\LoginRequest;
use Modules\Staff\Http\Requests\ForgotRequest;
use Modules\Staff\Http\Requests\LockRequest;
// ************ Mails ************
use Modules\Staff\Emails\ForgotPasswordMail;
// ************ Models ************
use App\User;

class AuthController extends StaffController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function get_login() {
        return view('staff::auth.login');
    }

    public function post_login(LoginRequest $request) {
        $model = User::where('email', '=', $request->input('email'))->where('type_id', '=', '2')->first();
        if (count($model) === 1 && Hash::check($request->input('password'), $model->password)) {
            if ($request->input('rememberMe') !== NULL) {
                $expire = time() + 3600;
                setcookie('staff_email', $request->input('email'), $expire);
                setcookie('staff_password', $request->input('password'), $expire);
            } else {
                $expire = time() - 3600;
                setcookie('staff_email', '', $expire);
                setcookie('staff_password', '', $expire);
            }
            Auth::guard('staff')->login($model);
            $model->last_login_at = Carbon::now()->toDateTimeString();
            $model->save();
            return redirect()->route('staff-dashboard')->with('success', 'You are successfully logged in.');
        } else {
            return redirect()->back()->with('danger', 'Incorrect Email or Password!');
        }
    }

    public function logout() {
        if (isset($_GET['type']) && $_GET['type'] === "lock") {
            $user = Auth::guard('staff')->user();
            $expire = time() + 3600;
            setcookie('staff_email_lock', $user->email, $expire);
            Auth::guard('staff')->logout();
            return redirect('staff/lockscreen');
        } else {
            Auth::guard('staff')->logout();
            return redirect('staff/login')->with('success', 'You are successfully logged out.');
        }
    }

    public function post_forgot_password(ForgotRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $password = $this->rand_string(8);
            $input = $request->all();
            $input['password'] = Hash::make($password);
            $model = User::where('type_id', '=', '2')->where('email', '=', $request->input('email'))->first();
            $model->update($input);
//                $email_setting = $this->get_email_data('staff_forgot_password', array('NAME' => $name, 'NEW_PASSWORD' => $password));
//                $email_data = [
//                    'to' => $model->email,
//                    'subject' => $email_setting['subject'],
//                    'template' => 'staff_forgot_password',
//                    'data' => ['message' => $email_setting['body']]
//                ];
//                $this->SendMail($email_data);
            Mail::to($model->email)->send(new ForgotPasswordMail($model, $password));
            $request->session()->flash('success', 'We have sent a new password to your email. Please check it.');
            return response()->json($data_msg);
        }
    }

    public function get_lockscreen() {
        if (!Auth::guard('staff')->guest()) {
            return redirect('staff/dashboard');
        }
        if (isset($_COOKIE['staff_email_lock']) && $_COOKIE['staff_email_lock'] !== NULL) {
            $model = User::where('type_id', '=', '2')->where('email', '=', $_COOKIE['staff_email_lock'])->first();
            return view('staff::auth.lock_screen', compact('model'));
        } else {
            return redirect('staff/login');
        }
    }

    public function post_lockscreen(LockRequest $request) {
        $model = User::where('type_id', '=', '2')->where('email', '=', $_COOKIE['staff_email_lock'])->first();
        Auth::guard('staff')->login($model);
        $expire = time() - 3600;
        setcookie('staff_email_lock', '', $expire);
        return redirect('staff/dashboard')->with('success', 'You are successfully unlocked.');
    }

}
