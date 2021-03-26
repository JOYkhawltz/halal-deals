@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('seo.index') }}">SEO</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Viewing details of {{ $model->route }}</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal">
            <div class="form-body">
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Route:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->route) && $model->route !== NULL) ? $model->route : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Title:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->title) && $model->title !== NULL) ? $model->title : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Keyword:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->keyword) && $model->keyword !== NULL) ? $model->keyword : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Description:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->description) && $model->description !== NULL) ? $model->description : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions text-right">
                <a href="{{ Route('seo.edit', ['id' => base64_encode($model->id)]) }}" class="btn green">
                    <i class="fa fa-pencil"></i> Edit
                </a>
                <a href="{{ Route('seo.index') }}" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
@stop