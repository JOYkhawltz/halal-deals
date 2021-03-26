@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('customer.index') }}">Customers</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Viewing details of {{ $model->full_name }}</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal">
            <div class="form-body">
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">First Name:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->first_name) && $model->first_name !== NULL) ? $model->first_name : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Last Name:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->last_name) && $model->last_name !== NULL) ? $model->last_name : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Email:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->email) && $model->email !== NULL) ? $model->email : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Phone:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->phone) && $model->phone !== NULL) ? $model->phone : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <input class="form-control-static" type="checkbox" onclick="return false" {{ (isset($model->cust_email_notification) && $model->cust_email_notification !== NULL) ? (($model->cust_email_notification == 1) ? 'checked' : '') : '' }}>
                        <label class="control-label col-md-3"> Email Preference:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <input class="form-control-static" type="checkbox" onclick="return false" {{ (isset($model->cust_phone_notification) && $model->cust_phone_notification !== NULL) ? (($model->cust_phone_notification == 1) ? 'checked' : '') : '' }}>
                        <label class="control-label col-md-3"> Phone Preference:</label>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Address1:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->address1) && $model->address1 !== NULL) ? $model->address1 : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Address2:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->address2) && $model->address2 !== NULL) ? $model->address2 : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Country:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($country_name->name) && $country_name->name !== NULL) ? $country_name->name : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Town:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->town) && $model->town !== NULL) ? $model->town : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">City:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->city) && $model->city !== NULL) ? $model->city : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Postal Code:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->post_code) && $model->post_code !== NULL) ? $model->post_code : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">GDPR Agreed Date:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->terms_and_cond_date) && $model->terms_and_cond_date !== NULL) ? date("d-M-Y", strtotime($model->terms_and_cond_date)) : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Status:</label>
                        <div class="col-md-9">
                            <p class="form-control-static">
                                @if($model->status == '0')
                                Inactive
                                @elseif($model->status == '1')
                                Active
                                @else
                                Block
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions text-right">
                <a href="{{ Route('customer.edit', ['id' => base64_encode($model->id)]) }}" class="btn green">
                    <i class="fa fa-pencil"></i> Edit
                </a>
                <a href="{{ Route('customer.index') }}" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
@stop