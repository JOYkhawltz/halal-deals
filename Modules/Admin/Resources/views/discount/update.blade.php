@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-discount') }}">Discount Management</a></li>
<li class="active">Update</li>
@stop

@section('content')
<div class="user-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Updating {{ $model->name }}</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('admin-discount-edit', ['id' => base64_encode($model->id)]) }}" method="POST" enctype="multipart/form-data" id="Update-Discount-Form">
                @csrf
                <div class="form-body  col-md-offset-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Discount Name <span class="required">*</span></label>
                                <input type="text" name="name" class="form-control" placeholder="Enter Discount Name" value="{{$model->name}}">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Discount Rate (in %) <span class="required">*</span></label>
                                <input type="text" name="discount_rate" class="form-control" placeholder="Enter Discount Rate" value="{{$model->discount_rate}}">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Status <span class="required">*</span></label>
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="0" {{($model->status=='0')?'checked':''}}> Inactive
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" {{($model->status=='1')?'checked':''}}> Active
                                    </label>
                                    <!-- <label class="radio-inline">
                                        <input type="radio" name="status" value="3" {{($model->status=='3')?'checked':''}}> Deleted
                                    </label> -->

                                    <div class="help-block"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-4 col-md-6">
                            <button type="submit" class="btn green">Update</button>
                            <a href="{{route('admin-discount')}}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
@stop