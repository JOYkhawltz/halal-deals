@extends('staff::layouts.lock')
@section('content')
<style>
    .help-block.help-block-error{
        position: absolute;
        bottom: -25px;
    }
</style>
<div class="page-lock">
    <div class="page-logo">
        <a class="brand" href="{{ Route('staff-lockscreen') }}">
            <img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="logo" style="width: 200px;" />
        </a>
    </div>
    <div class="page-body">
        <img class="page-lock-img" src="{{ URL::asset('public/uploads/staff/profile_picture/preview/' . $model->image) }}" onerror="this.src='{{ URL::asset('public/backend/assets/pages/img/admin-default.jpg') }}'" alt="">
        <div class="page-lock-info">
            <h1>{{ ((isset($model->full_name) && $model->full_name !== NULL) ? $model->full_name : "Not Given") }}</h1>
            <span class="email"> {{ $model->email }} </span>
            <span class="locked"> Locked </span>
            <form id="lock-form" class="login-form" action="{{ Route('staff-lockscreen') }}" method="POST">
                @csrf
                <div class="input-group input-medium">
                    <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                        @if ($errors->has('password'))
                        <div class="help-block help-block-error">{{ $errors->first('password') }}</div>
                        @endif
                    </div>
                    <span class="input-group-btn">
                        <button type="submit" class="btn green icn-only" name="lock-button"><i class="m-icon-swapright m-icon-white"></i></button>
                    </span>
                </div>
                <!-- /input-group -->
                <!--            <div class="relogin">
                                <a href="login.html"> Not Bob Nilson ? </a>
                            </div>-->
            </form>
        </div>
    </div>
    <div class="page-footer-custom"> {{ date('Y') }} &copy; {{ env('APP_NAME', 'Laravel') }}. </div>
</div>
@stop