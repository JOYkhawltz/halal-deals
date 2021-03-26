@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('product-type.index') }}">Product Types</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Viewing details of {{ $model->name }}</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal">
            <div class="form-body">
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Name:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->name) && $model->name !== NULL) ? $model->name : "Not Given" }} </p>
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
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions text-right">
                <a href="{{ Route('product-type.edit', ['id' => base64_encode($model->id)]) }}" class="btn green">
                    <i class="fa fa-pencil"></i> Edit
                </a>
                <a href="{{ Route('product-type.index') }}" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
@stop