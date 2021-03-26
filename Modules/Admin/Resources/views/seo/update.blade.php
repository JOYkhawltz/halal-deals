@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('seo.index') }}">SEO</a></li>
<li> <a href="{{ Route('seo.show', ['id' => base64_encode($model->id)]) }}">{{ $model->route }}</a></li>
<li class="active">Update</li>
@stop

@section('content')
<div class="seo-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Updating details of {{ $model->route }}</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('seo.update', ['id' => base64_encode($model->id)]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-body">
                    <div class="form-group {{ $errors->has('route') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Route</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="route" value="{{ (old('route') !== NULL) ? old('route') : $model->route }}" placeholder="Route" disabled>
                            @if ($errors->has('route'))
                            <div class="help-block">{{ $errors->first('route') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Title</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="title" value="{{ (old('title') !== NULL) ? old('title') : $model->title }}" placeholder="Title">
                            @if ($errors->has('title'))
                            <div class="help-block">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('keyword') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Keyword</label>
                        <div class="col-md-6">
                            <textarea class="form-control" name="keyword" placeholder="Keyword" rows="6">{{ (old('keyword') !== NULL) ? old('keyword') : $model->keyword }}</textarea>
                            @if ($errors->has('keyword'))
                            <div class="help-block">{{ $errors->first('keyword') }}</div>
                            @endif
                        </div>
                    </div>
                    <div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Description</label>
                        <div class="col-md-6">
                            <textarea class="form-control" name="description" placeholder="Description" rows="6">{{ (old('description') !== NULL) ? old('description') : $model->description }}</textarea>
                            @if ($errors->has('description'))
                            <div class="help-block">{{ $errors->first('description') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn green">Update</button>
                            <a href="{{ Route('seo.show', ['id' => base64_encode($model->id)]) }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop