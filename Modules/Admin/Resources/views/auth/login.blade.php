@extends('admin::layouts.login')
@section('content')
<div class="login-content">
    <h1>{{ env('APP_NAME', 'Laravel') }} Admin Login</h1>
    <p> Lorem ipsum dolor sit amet, coectetuer adipiscing elit sed diam nonummy et nibh euismod aliquam erat volutpat. Lorem ipsum dolor sit amet, coectetuer adipiscing. </p>
    <form id="admin-login-form" class="login-form" action="{{ Route('admin-login') }}" method="POST">
        @if(Session::has('success'))
        <div class="alert alert-success fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <span>{{ Session::get('success') }}</span>
        </div>
        @endif
        @if(Session::has('danger'))
        <div class="alert alert-danger fade in">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
            <span>{{ Session::get('danger') }}</span>
        </div>
        @endif
        @csrf
        <div class="row">
            <div class="col-xs-6">
                <input class="form-control form-control-solid placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Email *" name="email" value="<?php
                if (isset($_COOKIE['admin_email']) && $_COOKIE['admin_email'] !== NULL) {
                    echo $_COOKIE['admin_email'];
                }
                ?>" required/> </div>
            <div class="col-xs-6">
                <input class="form-control form-control-solid placeholder-no-fix form-group" type="password" placeholder="Password *" name="password" value="<?php
                if (isset($_COOKIE['admin_password']) && $_COOKIE['admin_password'] !== NULL) {
                    echo $_COOKIE['admin_password'];
                }
                ?>" required/> </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="rem-password">
                    <p>Remember Me
                        <input type="checkbox" name="rememberMe" value="1" <?php
                        if (isset($_COOKIE['admin_email']) && $_COOKIE['admin_password'] !== NULL) {
                            echo 'checked="checked"';
                        }
                        ?> class="rem-checkbox" />
                    </p>
                </div>
            </div>
            <div class="col-sm-8 text-right">
                <div class="forgot-password">
                    <a href="javascript:;" id="forget-password" class="forget-password">Forgot Password?</a>
                </div>
                <button type="submit" class="btn btn green" name="login-button">Login</button>
            </div>
        </div>
    </form>
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <div class="alert alert-danger" style="margin-top: 0; display:none;">
        <button class="close" data-close="alert"></button>
        <div class="errorMsg" id="err_email"></div>
    </div>
    <form id="admin-forgot-password-form" class="forget-form">
        @csrf
        @method('PUT')
        <h3 class="font-green">Forgot Password ?</h3>
        <p> Enter your e-mail address below to reset your password. </p>
        <div class="form-group">
            <input class="form-control placeholder-no-fix form-group" type="text" autocomplete="off" placeholder="Email *" name="email" />
        </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn grey btn-default">Back</button>
            <button type="submit" id="submit-btn" class="btn blue btn-success uppercase pull-right">Submit</button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
</div>
<div class="login-footer">
    <div class="row bs-reset">
        <div class="col-xs-5 bs-reset">
            <ul class="login-social">
                <li>
                    <a href="javascript:;">
                        <i class="icon-social-facebook"></i>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="icon-social-twitter"></i>
                    </a>
                </li>
                <li>
                    <a href="javascript:;">
                        <i class="icon-social-dribbble"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-xs-7 bs-reset">
            <div class="login-copyright text-right">
                <p>Copyright &copy; {{ env('APP_NAME', 'Laravel') }} {{ date('Y') }}</p>
            </div>
        </div>
    </div>
</div>
@stop