@extends('layouts.main')
@section('content')
<div class="log-area">
<div class="container">
    <div class="row d-fex justify-content-center">
        <div class="col-lg-8 col-sm-12">
            

<div class="form-log-in">
    <div class="title text-center mb-4">
        <span class="main-title">business signup</span>
    </div>
    <form id="signup-form" action="{{ route('signup') }}" method="POST">
        @csrf
        <input type="radio" name="type_id" class="signup-business-type" value="3" checked hidden>
    <div class="form-row">
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
    <div class="form-row">
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
    <div class="form-row">
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
    <div class="form-row">
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" name="business_name" placeholder="Business name">
                <div class="help-block" id="error-business_name"></div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <input type="text" class="form-control" name="address1" placeholder="Address1">
                <div class="help-block" id="error-address1"></div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col-sm-12">
        </div>
        <div class="col-sm-12">
            <div class="form-group">
                <input type="text" class="form-control" name="address2" placeholder="Address2">
                <div class="help-block" id="error-address2"></div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <input type="text" class="form-control" name="town" placeholder="Town">
            <div class="help-block" id="error-town"></div>
        </div>
        <div class="form-group col-md-4">
            <input type="text" class="form-control" name="city" placeholder="City">
            <div class="help-block" id="error-city"></div>
        </div>
        <div class="form-group col-md-2">
            <input type="text" class="form-control" name="postcode" placeholder="Postcode">
            <div class="help-block" id="error-postcode"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label class="container-check"> Please click to accept the <a href="" target="_blank">terms and conditions</a> of being a client of Halal Deals.
                    <input type="checkbox" name="terms_and_cond_agreed" checked="checked">
                    <span class="checkmark"></span>
                </label>
                <div class="help-block" id="error-terms_and_cond_agreed"></div>
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
    <div class="footer-txt text-center">Already have an account?? <a href="javascript:;" onclick="showSigninModal();">Login</a></div>
</form>
</div>
         </div>
    </div>           
</div>
</div>
@stop