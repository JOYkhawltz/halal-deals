@extends('admin::layouts.main')

@section('breadcrumb')
<li class="active">My Profile</li>
@stop

@section('content')
<link href="{{ URL::asset('public/backend/assets/pages/css/profile.min.css') }}" rel="stylesheet" type="text/css" />
<style>
    .profile-userpic img {
        width: 150px;
        height: 150px;
    }
    .deleteImage {
        position: absolute;
        top: -9px;
        margin-left: 150px;
        background: #17c4bb;
        border-radius: 50% !important;
        padding: 3px 7px;
    }
</style>
<div class="row">
    <div class="col-md-12">
        <div class="profile-sidebar">
            <div class="portlet light profile-sidebar-portlet">
                <div class="profile-userpic">
                    <img alt="" class="img-responsive" src="{{ URL::asset('public/uploads/admin/profile_picture/preview/' . $model->image) }}" onerror="this.src='{{ URL::asset('public/backend/assets/pages/img/admin-default.jpg') }}'" />
                </div>
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name"> {{ ((isset($model->full_name) && $model->full_name !== NULL) ? $model->full_name : "Not Given") }}</div>
                </div>
                <div class="profile-usermenu"></div>
            </div>
        </div>
        <div class="profile-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light ">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Account Settings</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="{{ ($active_tab === 'tab_1') ? 'active' : '' }}">
                                    <a href="#tab_1" data-toggle="tab">Personal Info</a>
                                </li>
                                <li class="{{ ($active_tab === 'tab_2') ? 'active' : '' }}">
                                    <a href="#tab_2" data-toggle="tab">Change Password</a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <div class="tab-pane {{ ($active_tab === 'tab_1') ? 'active' : '' }}" id="tab_1">
                                    <form id="admin-profile-form" action="{{ Route('admin-myprofile') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name='tab' value="tab_1">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                                    <label class="control-label">First Name <span class="required">*</span></label>
                                                    <input type="text" name="first_name" class="form-control" placeholder="First Name" value="{{ (old('first_name') !== NULL) ? old('first_name') : $model->first_name }}">
                                                    @if ($errors->has('first_name'))
                                                    <div class="help-block">{{ $errors->first('first_name') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                                    <label class="control-label">Last Name <span class="required">*</span></label>
                                                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" value="{{ (old('last_name') !== NULL) ? old('last_name') : $model->last_name }}">
                                                    @if ($errors->has('last_name'))
                                                    <div class="help-block">{{ $errors->first('last_name') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                            <label class="control-label">E-mail <span class="required">*</span></label>
                                            <input type="text" name="email" class="form-control" placeholder="E-mail" value="{{ (old('email') !== NULL) ? old('email') : $model->email }}">
                                            @if ($errors->has('email'))
                                            <div class="help-block">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
                                            <label class="control-label" style="display:block;">Profile Picture</label>
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                    <img src="{{ URL::asset('public/uploads/admin/profile_picture/thumb/' . $model->image) }}" onerror="this.src='{{ URL::asset('public/backend/assets/pages/img/admin-default.jpg') }}'" alt=""> 
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                <div>
                                                    <span class="btn default btn-file">
                                                        <span class="fileinput-new"> Select Image </span>
                                                        <span class="fileinput-exists"> Change </span>
                                                        <input type="file" name="image">
                                                    </span>
                                                    <a href="javascript:;" class="btn default fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                </div>
                                            </div>
                                            @if ($errors->has('image'))
                                            <div class="help-block">{{ $errors->first('image') }}</div>
                                            @endif
                                        </div>
                                        <hr/>
                                        <div class="margiv-top-10 text-right">
                                            <button type="submit" class="btn green">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane {{ ($active_tab === 'tab_2') ? 'active' : '' }}" id="tab_2">
                                    <form id="admin-password-form" action="{{ Route('admin-changepassword') }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name='tab' value="tab_2">
                                        <div class="form-group {{ $errors->has('old_password') ? ' has-error' : '' }}">
                                            <label class="control-label">Old Password <span class="required">*</span></label>
                                            <input type="password" name="old_password" class="form-control" placeholder="Old Password" value="{{ (old('old_password') !== NULL) ? old('old_password') : '' }}">
                                            @if ($errors->has('old_password'))
                                            <div class="help-block">{{ $errors->first('old_password') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('new_password') ? ' has-error' : '' }}">
                                            <label class="control-label">New Password <span class="required">*</span></label>
                                            <input type="password" name="new_password" class="form-control" placeholder="New Password" value="{{ (old('new_password') !== NULL) ? old('new_password') : '' }}">
                                            @if ($errors->has('new_password'))
                                            <div class="help-block">{{ $errors->first('new_password') }}</div>
                                            @endif
                                        </div>
                                        <div class="form-group {{ $errors->has('retype_password') ? ' has-error' : '' }}">
                                            <label class="control-label">Retype Password <span class="required">*</span></label>
                                            <input type="password" name="retype_password" class="form-control" placeholder="Retype Password" value="{{ (old('retype_password') !== NULL) ? old('retype_password') : '' }}">
                                            @if ($errors->has('retype_password'))
                                            <div class="help-block">{{ $errors->first('retype_password') }}</div>
                                            @endif
                                        </div>
                                        <hr/>
                                        <div class="margin-top-10 text-right">
                                            <button type="submit" class="btn green">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
@stop

@section('js')
<script src="{{ URL::asset('public/backend/assets/global/plugins/jquery.sparkline.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/backend/assets/pages/scripts/profile.min.js') }}" type="text/javascript"></script>
@stop
