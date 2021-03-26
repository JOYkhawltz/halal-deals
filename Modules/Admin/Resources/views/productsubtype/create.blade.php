@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('product-type.index') }}">Product Types</a></li>
<li> <a href="{{ Route('product-type.index', ['id' => $id]) }}">Product Sub Types</a></li>
<li class="active">Create</li>
@stop

@section('content')
<div class="user-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Creating Product Sub Type</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('product-sub-type.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="parent_id" value="{{ base64_decode($id) }}">
                <div class="form-body">
                    <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-4 control-label">Name <span class="required">*</span></label>
                        <div class="col-md-5">
                            <input type="text" class="form-control" name="name" value="{{ (old('name') !== NULL) ? old('name') : "" }}" placeholder="Name">
                            @if ($errors->has('name'))
                            <div class="help-block">{{ $errors->first('name') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn green">Create</button>
                            <a href="{{ Route('product-sub-type.index', ['id' => $id]) }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop