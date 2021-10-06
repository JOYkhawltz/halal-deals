<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Socialite;
// ************ Requests ************
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ForgotRequest;
use App\Http\Requests\ResetRequest;
use App\Http\Requests\SocialSignupRequest;
use App\Http\Requests\ContactUsRequest;
// ************ Mails ************
use App\Mail\Registration;
use App\Mail\ForgotPassword;
use App\Mail\Thankyou;
use App\Mail\ResendActiveTokenMail;
// ************ Models ************
use App\User;
use App\StaticPage;
use App\Business;
use App\Faq;
use App\Advert;
use App\Product;
use App\Cart;
use App\OrderMaster;
use App\Contact;
use App\Cms;
use App\Setting;

class SiteController extends Controller {

    public function index() {
        $data = [];
        $data['deals'] = Advert::with("business")->where('advert_type', '=', 'deal')->where('deal_end', '>=', Carbon::now(get_local_time())->format('Y-m-d'))->where('status', '1')->take(6)->get();
        $data['hot_deals'] = Advert::with("business")->where('advert_type', '=', 'deal')->where('deal_end', '>=', Carbon::now(get_local_time())->format('Y-m-d'))->where('status', '1')->where('hotoffer',1)->take(6)->get();
        $data['today_deals'] = Advert::select('*')->where('deal_start', Carbon::now(get_local_time())->format('Y-m-d'))->where('status', '1')->get();
        $data['vouchers'] = Advert::select('*')->where('advert_type', '=', 'voucher')->where('status', '1')->take(6)->get();
        $data['pages'] = Cms::select('type', 'content_body')->where('page_name','Home Page')->get();
        $data['search_and_text_area'] = Setting::select('value')->where('slug','enable_or_disable_search_box_and_text_in_banner')->first();
//        print_r($data);exit;
        return view('site.index', $data);
    }

    public function show_voucher() {
        $data['vouchers'] = Advert::select('*')->where('advert_type', '=', 'voucher')->where('status', '1')->get();
        return view('site.allvoucher', $data);
    }

    public function voucher_details($id) {
        $data = [];
        $data['advert_detail'] = $details = Advert::findOrFail($id);
//        $data['model'] = $model = Product::findOrFail($details->prod_ID);
        $data['bus_desc'] = $bus_detail = Business::findOrFail($details->bus_ID);
        $data['user'] = User::where('id', '=', $bus_detail->user_id)->first();
//        $data['adverts'] = Advert::where('prod_ID', $details->prod_ID)->where('date_finish', '>=', Carbon::now()->format('Y-m-d'))->where('status', '=', '1')->where('advert_ID', '<>', $id)->get();
        if ($details->other_options_available == '2') {
            return view('site.voucherdetails', $data);
        } else {
            if ($details->new_cust_only == '1') {
                $user_id = Auth()->guard('frontend')->user()->id;
                $order = OrderMaster::where('user_id', $user_id)->count();
                if ($order > 0) {
                    return \Redirect::back()->with('error', 'This is only for new customer ');
                } else {
                    return view('site.voucherdetails', $data);
                }
            } else {
                return view('site.voucherdetails', $data);
            }
        }
    }

    public function post_signup(RegisterRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            $marketing_notifications = ($request->has('marketing_notifications')) ? '1' : '0';
            $terms_and_cond_agreed = ($request->has('terms_and_cond_agreed')) ? '1' : '0';
            if ($request->input('type_id')=== '4') {
                $input['cust_id']="C".$this->rand_string(5);
                $input['terms_and_cond_agreed']=$terms_and_cond_agreed;
                $input['terms_and_cond_date']=Carbon::now()->toDateTimeString();
                $input['cust_email_notification'] = $marketing_notifications;
                $input['cust_phone_notification'] = $marketing_notifications;
            }else{
                $input['terms_and_cond_agreed']=$terms_and_cond_agreed;
                $input['terms_and_cond_date']=Carbon::now()->toDateTimeString();
            }
            $input['password'] = Hash::make($input['password']);
            $input['active_token'] = $this->rand_string(20);
            $model = User::create($input);
            if ($model->type_id === '3') {
                
                Business::create(['bus_ID' => $this->get_business_id(), 'user_id' => $model->id, 'name' => $request->input('business_name'),'address1'=>$request->input('address1'),'address_longitude'=>$request->input('address_longitude'),'address_latitude'=>$request->input('address_latitude'),'address2'=>$request->input('address2'),'town'=>$request->input('town'),"city"=>$request->input('city'),'post_code'=>$request->input("postcode"), 'terms_and_cond_agreed' => $terms_and_cond_agreed, 'terms_and_cond_date' => date('Y-m-d')]);
            }
            $link = Route('active-account', ['id' => base64_encode($model->id), 'token' => $model->active_token]);

//                $email_setting = $this->get_email_data('user_registration', array('NAME' => $model->first_name, 'LINK' => $link));
//                $email_data = [
//                    'to' => $model->email,
//                    'subject' => $email_setting['subject'],
//                    'template' => 'signup',
//                    'data' => ['message' => $email_setting['body']]
//                ];
//                $this->SendMail($email_data);
            if ($model->type_id == 4)
                $email_setting = $this->get_email_data('customer_registration', array('NAME' => $input['first_name'], 'EMAIL' => $input['email'], 'LINK' => $link));
            elseif ($model->type_id == 3)
                $email_setting = $this->get_email_data('vendor_registration', array('NAME' => $input['first_name'], 'EMAIL' => $input['email'], 'LINK' => $link));
            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'signup',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
            $data_msg['u_id'] = $model->id;
            $data_msg['link'] = Route('/');
           
            $data_msg['msg'] = "You are successfully registered. Please check your email to verify your account.";
            return response()->json($data_msg);
        }
    }

    public function resend_active_token(Request $request) {
        if ($request->ajax()) {
            $user_id = $request->input('id');
            if (!empty($user_id)) {
                $model = User::findorFail($user_id);
            } else {
                $model = NULL;
            }
            if (count($model) > 0 && $model->active_token !== NULL) {
                $link = Route('active-account', ['id' => base64_encode($model->id), 'token' => $model->active_token]);
                Mail::to($model->email)->send(new ResendActiveTokenMail($model, $link));
                $data['msg'] = 'A resend mail send to your registered mail address.';
                $data['status'] = 200;
            } else {
                $data['msg'] = 'Opps! something went wrong.';
            }
            return response()->json($data);
        }
    }

    public function get_active_account(Request $request, $id, $token) {
        if ($id == "" && $token == "") {
            return redirect()->route('/')->with('error', 'Oops! Something went wrong in this url.');
        }
        $id = base64_decode($id);
        $model = User::where('id', $id)->where('active_token', $token)->first();
        if (count($model) === 0)
            return redirect()->route('/')->with('error', 'Requested url is no longer valid. Please try again.');
        else {
            Auth::guard('frontend')->login($model);
            $model->email_verified_at = Carbon::now()->toDateTimeString();
            $model->active_token = NULL;
            $model->status = '1';
            $model->last_login_at = Carbon::now()->toDateTimeString();
            $model->save();
            Mail::to($model->email)->send(new Thankyou($model));
            return redirect()->route('/')->with('success', 'Your account has been activated successfully.');
        }
    }
    
    public function business_signup()
    {
        $data=[];
        return view("site.business_signup",$data);
    }

    public function post_login(LoginRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->only('email');
            $model = User::where('email', '=', $input['email'])->first();
            if ($request->input('rememberMe') !== '') {
                $expire = time() + 172800;
                setcookie('user_email', $request->input('email'), $expire);
                setcookie('user_password', $request->input('password'), $expire);
            } else {
                $expire = time() - 172800;
                setcookie('user_email', '', $expire);
                setcookie('user_password', '', $expire);
            }
            Auth::guard('frontend')->login($model);
            $model->last_login_at = Carbon::now()->toDateTimeString();
            $model->save();
            if (Cookie::has('guest_user_halaldeals') && $model->type_id === '4') {
                $user_id = Cookie::get('guest_user_halaldeals');
                $array = Cart::select('advert_ID')->where('user_id', '=', $model->id)->whereStatus('1')->get()->toArray();
                $usercarts = Arr::flatten($array);
                $products = Cart::where('user_id', '=', $user_id)->whereStatus('1')->get();
                if (count($products) > 0) {
                    foreach ($products as $product) {

                        if (!in_array($product->advert_ID, $usercarts)) {
                            $product->user_id = $model->id;
                            $product->save();
                        }
                    }
                }
//                if (count($products) > 0) {
//                    foreach ($products as $product) {
//                        $product->user_id = $model->id;
//                        $product->save();
//                    }
//                }
                Cookie::forget('guest_user_halaldeals');
            }
            $data_msg['link'] = Route('/');
            $request->session()->flash('success', 'You are successfully logged in.');
            return response()->json($data_msg);
        }
    }

    public function redirectToProvider($name) {
        if ($name !== "outlook")
            return Socialite::driver($name)->redirect();
        else {
            $urls = 'https://login.live.com/oauth20_authorize.srf?client_id=' . env('OAUTH_APP_ID') . '&scope=wl.signin%20wl.basic%20wl.emails%20wl.contacts_emails&response_type=code&redirect_uri=' . env('OAUTH_REDIRECT_URI');
            return redirect($urls);
        }
    }

    public function handleProviderCallback(Request $request, $name) {
        if ($name === "facebook") {
            $user = Socialite::driver($name)->user();
            if ($user->email !== NULL) {
                $findUser = User::where('email', $user->email)->first();
                if (count($findUser) > 0) {
                    Auth::guard('frontend')->loginUsingId($findUser->id);
                    $request->session()->flash('success', 'You are successfully logged in.');
                } else {
                    $session_data = [
                        'social_id' => $user->id,
                        'account_type' => '1',
                        'first_name' => $user->name,
                        'last_name' => NULL,
                        'email' => $user->email,
                        'image' => $user->avatar,
                    ];
                    session($session_data);
                }
            } else {
                $findUser = User::where('account_type', '=', '1')->where('social_id', '=', $user->id)->first();
                if (count($findUser) > 0) {
                    Auth::guard('frontend')->loginUsingId($findUser->id);
                    $request->session()->flash('success', 'You are successfully logged in.');
                } else {
                    $session_data = [
                        'social_id' => $user->id,
                        'account_type' => '1',
                        'first_name' => $user->name,
                        'last_name' => NULL,
                        'image' => $user->avatar,
                    ];
                    session($session_data);
                }
            }
            return redirect()->route('/');
        } else if ($name === "google") {
            $user = Socialite::driver($name)->user();
            $findUser = User::where('email', $user->email)->first();
            if (count($findUser) > 0) {
                Auth::guard('frontend')->loginUsingId($findUser->id);
                $request->session()->flash('success', 'You are successfully logged in.');
            } else {
                $session_data = [
                    'social_id' => $user->id,
                    'account_type' => '2',
                    'first_name' => $user->name,
                    'last_name' => NULL,
                    'email' => $user->email,
                    'image' => $user->avatar,
                ];
                session($session_data);
            }
            return redirect()->route('/');
        } else {
            $url = 'code=' . urlencode($_REQUEST['code']) . '&client_id=' . urlencode(env('OAUTH_APP_ID')) . '&client_secret=' . urlencode(env('OAUTH_APP_PASSWORD')) . '&redirect_uri=' . urlencode(env('OAUTH_REDIRECT_URI')) . '&grant_type=authorization_code';
            $post = rtrim($url, '&');
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, 'https://login.live.com/oauth20_token.srf');
            curl_setopt($curl, CURLOPT_POST, 5);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
            $result = curl_exec($curl);
            curl_close($curl);
            $response = json_decode($result);
            $get_profile_url = 'https://apis.live.net/v5.0/me?access_token=' . $response->access_token;
            $xmlprofile_res = $this->curl_file_get_contents($get_profile_url);
            $user = json_decode($xmlprofile_res, true);

            $findUser = User::where('email', $user['emails']['account'])->first();
            if (count($findUser) > 0) {
                Auth::guard('frontend')->loginUsingId($findUser->id);
                $request->session()->flash('success', 'You are successfully logged in.');
            } else {
                $session_data = [
                    'social_id' => $user['id'],
                    'account_type' => '3',
                    'first_name' => $user['first_name'],
                    'last_name' => $user['last_name'],
                    'email' => $user['emails']['account'],
                    'image' => NULL,
                ];
                session($session_data);
            }
            return redirect()->route('/');
        }
    }

    public function curl_file_get_contents($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    public function post_social_signup(SocialSignupRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $data = [
                'type_id' => $request->input('type_id'),
                'social_id' => $request->session()->get('social_id'),
                'account_type' => $request->session()->get('account_type'),
                'first_name' => $request->session()->get('first_name'),
                'last_name' => $request->session()->get('last_name'),
                'email' => $request->session()->has('email') ? $request->session()->get('email') : $request->input('email'),
                'image' => $request->session()->get('image'),
                'email_verified_at' => Carbon::now()->toDateTimeString(),
                'status' => '1',
                'last_login_at' => Carbon::now()->toDateTimeString(),
                'terms_and_cond_agreed' => '1',
                'terms_and_cond_date' => Carbon::now()->toDateTimeString(),
            ];
            if ($request->input('type_id')=== '4') {
                $data['cust_id']="C".$this->rand_string(5);
                $data['cust_email_notification'] = '1';
                $data['cust_email_notification'] = '1';
            }
            $model = User::create($data);
            if ($model->type_id === '3') {
                $bus_id = $this->get_business_id();
                Business::create(['bus_ID' => $bus_id, 'user_id' => $model->id, 'terms_and_cond_agreed' => '1', 'terms_and_cond_date' => date('Y-m-d')]);
            }
            $findUser = User::where('social_id', '=', $request->session()->get('social_id'))->first();
            Auth::guard('frontend')->loginUsingId($findUser->id);
            Mail::to($model->email)->send(new Thankyou($model));
            $request->session()->forget('social_id');
            $request->session()->forget('first_name');
            $request->session()->forget('last_name');
            $request->session()->forget('email');
            $request->session()->forget('image');
            $data_msg['link'] = Route('/');
            return response()->json($data_msg);
        }
    }

    public function logout() {
        Auth::guard('frontend')->logout();
        return redirect('/')->with('success', 'You are successfully logged out.');
    }

    public function post_forgot_password(ForgotRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            $input['reset_token'] = $this->rand_string(20);
            $model = User::where('email', '=', $input['email'])->first();
            $model->update($input);
            $link = Route('reset-password', ['id' => base64_encode($model->id), 'token' => $model->reset_token]);

            $email_setting = $this->get_email_data('forgot_password', array('NAME' => $model->first_name, 'EMAIL' => $input['email'], 'LINK' => $link));
            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'forgot_password',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);
            $data_msg['msg'] = 'Your reset password link has been sent to your email.';
            return response()->json($data_msg);
        }
    }

    public function get_reset_password($id, $token) {
        if ($id === "" && $token === "") {
            return redirect()->route('/')->with('error', 'oops! Something went wrong in this url.');
        }
        $id = base64_decode($id);
        $model = User::where('id', $id)->where('reset_token', $token)->first();
        if (count($model) === 0)
            return redirect()->route('/')->with('error', 'oops! Something went wrong in this url.');
        else {
            Session::put('user_id', $id);
            Session::put('forgot_token', $token);
            return redirect()->route('/');
        }
    }

    public function post_reset_password(ResetRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $input = $request->all();
            $input['password'] = Hash::make($input['password']);
            $input['reset_token'] = NULL;
            $user_id = Session::get('user_id');
            $model = User::findOrFail($user_id);
            $model->update($input);
            Session::remove('user_id');
            Session::remove('forgot_token');
            $data_msg['msg'] = 'Your password changed successfully.';
            return response()->json($data_msg);
        }
    }

    public function get_static_page(Request $request) {
        $data = [];
        if ($request->route()->named('about-us')) {
            $data['model'] = StaticPage::where('slug', '=', 'about_us')->first();
            return view('site.static_page', $data);
        } else if ($request->route()->named('how-it-works')) {
            $data['model'] = StaticPage::where('slug', '=', 'how_it_works')->first();
            return view('site.static_page', $data);
        } else if ($request->route()->named('privacy-policy')) {
            $data['model'] = StaticPage::where('slug', '=', 'privacy_policy')->first();
            return view('site.static_page', $data);
        } else if ($request->route()->named('terms-condition')) {
            $data['model'] = StaticPage::where('slug', '=', 'terms_conditions')->first();
            return view('site.static_page', $data);
        }else if ($request->route()->named('help')) {
            $data['model'] = StaticPage::where('slug', '=', 'help')->first();
            return view('site.help', $data);
        }else {
            return redirect()->route('login');
        }
    }

    public function get_faq() {
        $data = [];
        $data['model'] = Faq::where('status', '1')->get();
        return view('site.faqs', $data);
    }

    public function get_business_id() {
        $unique_id = "B".$this->rand_string(5);
        $checkBusId = Business::where('bus_ID', $unique_id)->count();
        if ($checkBusId !== 0) {
            return $this->get_business_id();
        } else {
            return $unique_id;
        }
    }
    public function get_contactus() {
        return view('site.contact_us');
    }

    public function post_contact(ContactUsRequest $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $admin_email = User::where('type_id', '=', '1')->first();
            $input = $request->all();
            $contact = Contact::create($input);

            if (!empty($admin_email)):
                $email_setting = $this->get_email_data('contact_us', array('ADMIN' => "Admin", 'NAME' => $contact->name, 'EMAIL' => $contact->email, 'SUBJECT' => $contact->subject,
                    'PHONE' => ($contact->phone_no != "") ? $contact->phone_no : 'Not Provided', 'MESSAGE' => $contact->message));
                $email_data = [
                    'to' => $admin_email->email,
                    'subject' => $email_setting['subject'],
                    'template' => 'signup',
                    'data' => ['message' => $email_setting['body']]
                ];
                $this->SendMail($email_data);
            endif;
            
            $data_msg['msg'] = 'Thank you for contacting us. We will Contact you soon.';
            return response()->json($data_msg);
        }
    }

}
