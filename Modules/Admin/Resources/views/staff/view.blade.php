@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-staff.index') }}">Staffs</a></li>
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
                <a href="{{ Route('admin-staff.edit', ['id' => base64_encode($model->id)]) }}" class="btn green">
                    <i class="fa fa-pencil"></i> Edit
                </a>
                <a href="{{ Route('admin-staff.index') }}" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
@stop