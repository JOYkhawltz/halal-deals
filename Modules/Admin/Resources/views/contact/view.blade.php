@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('contact.index') }}">User Contacts</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">View Message Details</span>
        </div>
    </div>
    <div class="portlet-body form">
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
                        <label class="control-label col-md-3">Email :</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->email) && $model->email !== NULL) ? $model->email : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Phone :</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->phone) && $model->phone !== NULL) ? $model->phone : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3"> Message :</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->message) && $model->message !== NULL) ?  $model->message : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Status:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ ($model->reply_status === '0') ? 'Not replied' : 'Replied' }} </p>
                        </div>
                    </div>
                </div>
                @if($model->reply_status === '1')
                <div class="row">
                    <div class="form-group">
                        <label class="control-label col-md-3">Reply Message:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{ (isset($model->reply_message) && $model->reply_message !== NULL) ?  $model->reply_message : "Not Given" }} </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </form>
        @if ($model->reply_status === '0')
        <form class="form-horizontal form-row-seperated" action="{{ Route('contact.update', ['id' => base64_encode($model->id)]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="form-group {{ $errors->has('reply_message') ? ' has-error' : '' }}">
                    <label class="control-label col-md-3">Reply to user:</label>
                    <div class="col-md-9">
                        <textarea class="form-control" name="reply_message" rows="6" placeholder="Type your reply message" >{{ (old('reply_message') !== NULL) ? old('reply_message') : "" }}</textarea>
                        @if ($errors->has('reply_message'))
                        <div class="help-block">{{ $errors->first('reply_message') }}</div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <button type="submit" class="btn green">Send Reply</button>
                </div>
            </div>
        </form>
        <br/>
        @endif
        <div class="form-actions text-right">
            <a href="{{ Route('contact.index') }}" class="btn default">Back</a>
        </div>
    </div>
</div>
@stop