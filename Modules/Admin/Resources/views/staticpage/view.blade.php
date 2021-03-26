@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('static-page.index') }}">Static Pages</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Viewing details of {{ $model->page_name }}</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal">
            <div class="form-body">
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Slug:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->slug) && $model->slug !== NULL) ? $model->slug : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Page Name:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->page_name) && $model->page_name !== NULL) ? $model->page_name : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Content:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {!! (isset($model->content) && $model->content !== NULL) ? $model->content : "Not Given" !!} </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions text-right">
                <a href="{{ Route('static-page.edit', ['id' => base64_encode($model->id)]) }}" class="btn green">
                    <i class="fa fa-pencil"></i> Edit
                </a>
                <a href="{{ Route('static-page.index') }}" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
@stop