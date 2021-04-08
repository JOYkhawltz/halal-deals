@php
use App\Setting;
use App\Cms;
$social_link = Setting::where('module', '=', 'Social Link')->get();
$text=Cms::where('slug','=','footer_text')->first();
@endphp
<section class="footer-section">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-4">
                    <div class="footer-info">
                        <div class="footer-logo"><img src="{{ URL::asset('public/frontend/images/footer-logo.png') }}"></div>
                        <div class="footer-info-txt">
                            
                            {!!$text->content_body!!}
                            
                        </div>
                        <div class="footer-social">
                            <a href="{{ ($social_link[0]->value != "") ? $social_link[0]->value : $social_link[0]->default }}" class="facebook"><i class="icofont-facebook"></i></a>
                            <a href="{{ ($social_link[1]->value != "") ? $social_link[1]->value : $social_link[0]->default }}" class="facebook"><i class="icofont-instagram"></i></a>
                            <a href="{{ ($social_link[2]->value != "") ? $social_link[2]->value : $social_link[0]->default }}" class="facebook"><i class="icofont-youtube"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-3 col-4 px_mob-2">
                    <div class="footer-menu">
                        <h2>IMPORTANT LINKS</h2>
                        <ul>
                            <li><a href="{{ Route('about-us') }}"><i class="icofont-rounded-right"></i> About</a></li>
                            <li><a href="{{ Route('how-it-works') }}"><i class="icofont-rounded-right"></i> How It Works</a></li>
                            <li><a href="{{ Route('privacy-policy') }}"><i class="icofont-rounded-right"></i> Privacy Policy</a></li>
                            <li><a href="{{ Route('terms-condition') }}"><i class="icofont-rounded-right"></i> Terms Of Use</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-4 col-sm-3 px_mob-2">
                    <div class="footer-menu">
                        <h2>USEFUL LINKS</h2>
                        <ul>
                            <li><a href="{{Route('get-faq')}}"><i class="icofont-rounded-right"></i> FAQ</a></li>
                            @if (Auth()->guard('frontend')->guest())
                            <li><a href="javascript:;" onclick="showSigninModal();"><i class="icofont-rounded-right"></i> Login / Sign Up</a></li>
                            @else
                            <li><a href="{{ Route('dashboard') }}"><i class="icofont-rounded-right"></i> Dashboard</a></li>
                            @endif
                            <li><a href="{{ Route('help') }}"><i class="icofont-rounded-right"></i> Help</a></li>
                            <li><a href="{{ Route('show-voucher') }}"><i class="icofont-rounded-right"></i> Top Vouchers</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-2 col-4 px_mob-2">
                    <div class="footer-menu">
                        <h2>USEFUL LINKS</h2>
                        <ul>
                            <li><a href="{{ Route('search-coupon') }}"><i class="icofont-rounded-right"></i> Latest Deals</a></li>
                            <li><a href="{{ Route('search-coupon') }}"><i class="icofont-rounded-right"></i> Top Deals</a></li>
                            @if (!(Auth()->guard('frontend')->guest()))
                            <li><a href="{{ Route('my-profile') }}"><i class="icofont-rounded-right"></i> My Account</a></li>
                            @endif
                            <li><a href="{{Route('contact-us')}}"><i class="icofont-rounded-right"></i> Contact Us</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright text-center">&copy; {{ date('Y') }} Copyright {{ env('APP_NAME', 'Laravel') }}. All Rights Reserved.</div>
</section>

@if (Auth()->guard('frontend')->guest())
<!-- Start Login Modal -->
<div class="modal custom-modal" id="signin_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="close-btn"><button type="button" class="close" data-dismiss="modal"><i class="icofont-close-line"></i></button></div>
                <h4 class="modal-title">Login</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="signin-form" action="{{ Route('login') }}" method="POST">
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email address">
                        <div class="help-block" id="err-email"></div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="help-block" id="err-password"></div>
                    </div>
                    <div class="form-group">
                        <div class="forgot-txt text-right"><a href="javascript:;" onclick="showForgotModal();">Forgot Password?</a></div>
                    </div>
                    <div class="form-group">
                        <div class="frm-btn text-center"><button class="deflt-btn" type="submit">Login to your account</button></div>
                    </div>
                    <div class="or-txt"><span>OR</span></div>
                    <div class="social-login">
                        <h2>Login With</h2>
                        <a href="{{ url('login', ['name' => 'facebook']) }}" class="facebook-log"><i class="icofont-facebook"></i> facebook</a>
                        <a href="{{ url('login', ['name' => 'google']) }}" class="google-log"><i class="icofont-google-plus"></i> Google+</a>
                        <a href="{{ url('login', ['name' => 'outlook']) }}" class="hotmail-log"><i class="icofont-email"></i> Hotmail</a>

                    </div>

                    <div class="modal-footer-txt text-center">Don't have an account? <a href="javascript:;" onclick="showSignupModal();">Sign Up</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal custom-modal" id="resend_activation_modal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="close-btn"><button type="button" class="close" data-dismiss="modal"><i class="icofont-close-line"></i></button></div>
                <h4 class="modal-title">Resend Activation Link</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="resend-activation-form" action="{{ Route('resend-active-token') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input type="hidden" name="id"> 
                        <div class="modal-footer-txt text-center">If you did't get the activation mail ? <button type="submit" class="deflt-btn">Resend Mail</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Login Modal -->

<!-- Start Signup Modal -->
<div class="modal custom-modal" id="signup_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="close-btn"><button type="button" class="close" data-dismiss="modal"><i class="icofont-close-line"></i></button></div>
                <h4 class="modal-title">Customer Sign Up</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="signup-form" action="{{ Route('signup') }}" method="POST">
                    @csrf
                    <input type="radio" name="type_id" class="signup-business-type" value="4" checked hidden>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="first_name" placeholder="First Name">
                                <div class="help-block" id="error-first_name"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                                <div class="help-block" id="error-last_name"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email address">
                                <div class="help-block" id="error-email"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="tel" class="form-control" name="phone" placeholder="Phone">
                                <div class="help-block" id="error-phone"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <div class="help-block" id="error-password"></div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                                <div class="help-block" id="error-confirm_password"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="container-check">Tick to agree to our <a href="{{route('terms-condition')}}" target="_blank">terms and conditions</a>
                                    <input type="checkbox" name="terms_and_cond_agreed" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                                <div class="help-block" id="error-terms_and_cond_agreed">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="container-check">Tick to receive personalised marketing emails and messages including special deals from <strong>{{ env('APP_NAME', 'Laravel') }}.co.uk.</strong>
                                    <input type="checkbox" name="marketing_notifications" checked="checked">
                                    <span class="checkmark"></span>
                                </label>
                                <div class="help-block" id="error-marketing_notifications">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="frm-btn text-center"><button class="deflt-btn" type="submit">Register Now</button></div>
                    </div>
                    <div class="or-txt"><span>OR</span></div>
                    
                    <div class="social-login">
                        <h2>Signup With</h2>
                        <a href="{{ url('login', ['name' => 'facebook']) }}" class="facebook-log"><i class="icofont-facebook"></i> facebook</a>
                        <a href="{{ url('login', ['name' => 'google']) }}" class="google-log"><i class="icofont-google-plus"></i> Google+</a>
                        <a href="{{ url('login', ['name' => 'outlook']) }}" class="hotmail-log"><i class="icofont-email"></i> Hotmail</a>

                    </div>
                    <div class="modal-footer-txt text-center">Already have an account?? <a href="javascript:;" onclick="showSigninModal();">Login</a></div>
                    <div class="modal-footer-txt text-center">Are you a business? <a href="{{route('business-signup')}}">Click here to advertise on Halal Deals</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Signup Modal -->

<!-- Start Forgot Modal -->
<div class="modal custom-modal" id="forgot_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="close-btn"><button type="button" class="close" data-dismiss="modal"><i class="icofont-close-line"></i></button></div>
                <h4 class="modal-title">Forgot Password</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="forgot-form" action="{{ Route('forgot-password') }}" method="POST">
                    @method('PUT')
                    <div class="form-group">
                        <input type="email" class="form-control" name="email" placeholder="Email address">
                        <div class="help-block" id="er-email"></div>
                    </div>
                    <div class="form-group">
                        <div class="frm-btn text-center"><button class="deflt-btn" type="submit">Submit</button></div>
                    </div>
                    <div class="modal-footer-txt text-center">Don't have an account? <a href="javascript:;" onclick="showSigninModal();">Sign In</a></div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Forgot Modal -->

<!-- Start Reset Modal -->
<div class="modal custom-modal" id="reset_password_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="close-btn"><button type="button" class="close" data-dismiss="modal"><i class="icofont-close-line"></i></button></div>
                <h4 class="modal-title">Reset Password</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="reset-password-form" action="{{ Route('set-password') }}" method="POST">
                    @method('PUT')
                    <input type="hidden" name="forgot_token" id="forgot_token" value="{{ Session::has('forgot_token') ? Session::get('forgot_token') : '' }}">
                    <div class="form-group">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="help-block" id="erro-password"></div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" name="retype_password" placeholder="Retype Password">
                        <div class="help-block" id="erro-retype_password"></div>
                    </div>
                    <div class="form-group">
                        <div class="frm-btn text-center"><button class="deflt-btn" type="submit">Save</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Reset Modal -->

@if(Session::has('social_id'))
<!-- Start Social Signup Modal -->
<div class="modal custom-modal" id="social_signup_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <div class="close-btn"><button type="button" class="close" data-dismiss="modal"><i class="icofont-close-line"></i></button></div>
                <h4 class="modal-title">Choose User Type</h4>
            </div>
            <!-- Modal body -->
            <div class="modal-body">
                <form id="social-signup-form" action="{{ Route('social-signup') }}" method="POST">
                    @csrf
                    <input type="hidden" id="social_type" value="1">
                    <div class="form-group text-center frm-radio">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group text-right">
                                    <label><input type="radio" name="type_id" value="3" checked> Business Manager</label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group text-left">
                                    <label><input type="radio" name="type_id" value="4"> Customer</label>
                                </div>
                            </div>
                        </div>
                        <div class="help-block" id="error_type_id"></div>
                    </div>
                    @if(!Session::has('email'))
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" value="{{ Session::get('email') }}" placeholder="Email address">
                                <div class="help-block" id="error_email"></div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <div class="frm-btn text-center"><button class="deflt-btn" type="submit">Submit</button></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</div>
<!-- End Social Signup Modal -->
@endif
@endif