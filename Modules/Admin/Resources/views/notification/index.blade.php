@extends('admin::layouts.main')
@section('breadcrumb')
<li>
    <span class="active">Notifications</span>
</li>
@stop

@section('content')


<div class="portlet box blue-hoki">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-bell"></i>
            Notifications
        </div>
<!--        <div class="pull-right"><a href="{{route('admin-addproduct')}}" class="btn btn-success" style="position: relative; top: 3px;"><i class="fa fa-plus"></i> Add New</a></div>-->
    </div>

</div>
<div>
    @if(count($models)>0)
    <div id="loadnoti">
        @foreach($models as $model)
        <div class="success alert-success text-center" role="success" >
            @if($model->type=='3')
            <li>
                <a href="javascript:void(0);"  data-location="{{ Route('admin-orders') }}" onclick="changenotistatus('{{$model->id}}', this);">
                    <span class="details">
                        <span class="label label-sm label-icon label-success">
                            <i class="fa fa-history"></i>
                            @if($model->status=='1')
                            <span>  {{$model->notify_msg}}</span>  
                            @else
                            <span>  <b>{{$model->notify_msg}}</b></span>
                            @endif
                        </span>
                    </span>
                </a>
                <br/>
                <span class="time">{{\Carbon\Carbon::parse($model->created_at)->format('d F ')}}</span>
            </li>
            @elseif($model->type=='6')
            <li>
                <a href="javascript:void(0);"  data-location="{{ Route('admin-products') }}" onclick="changenotistatus('{{$model->id}}', this);">
                    <span class="details">
                        <span class="label label-sm label-icon label-success">
                            <i class="icon-equalizer"></i>
                            @if($model->status=='1')
                            <span>  {{$model->notify_msg}}</span>  
                            @else
                            <span>  <b>{{$model->notify_msg}}</b></span>
                            @endif
                        </span>
                    </span>
                </a>
                <br/>
                <span class="time">{{\Carbon\Carbon::parse($model->created_at)->format('d F ')}}</span>
            </li>
            @elseif($model->type=='7')
            <li>
                <a  href="javascript:void(0);"  data-location="{{ Route('admin-deal-adverts') }}" onclick="changenotistatus('{{$model->id}}', this);">
                    <span class="details">
                        <span class="label label-sm label-icon label-success">
                            <i class="fa fa-ticket"></i>
                            @if($model->status=='1')
                            <span>  {{$model->notify_msg}}</span>  
                            @else
                            <span>  <b>{{$model->notify_msg}}</b></span>
                            @endif                       
                        </span>
                    </span>
                </a>
                <br/>
                <span class="time">{{\Carbon\Carbon::parse($model->created_at)->format('d F ')}}</span>
            </li>
            @elseif($model->type=='8')
            <li>
                <a  href="javascript:void(0);"  data-location="{{ Route('admin-voucher-adverts') }}" onclick="changenotistatus('{{$model->id}}', this);">
                    <span class="details">
                        <span class="label label-sm label-icon label-success">
                            <i class="fa fa-ticket"></i>
                            @if($model->status=='1')
                            <span>  {{$model->notify_msg}}</span>  
                            @else
                            <span>  <b>{{$model->notify_msg}}</b></span>
                            @endif                       
                        </span>
                    </span>
                </a>
                <br/>
                <span class="time">{{\Carbon\Carbon::parse($model->created_at)->format('d F ')}}</span>
            </li>
             @elseif($model->type=='9')
            <li>
                <a  href="javascript:void(0);"  data-location="{{ Route('admin-wallet-management') }}" onclick="changenotistatus('{{$model->id}}', this);">
                    <span class="details">
                        <span class="label label-sm label-icon label-success">
                            <i class="fa fa-money"></i>
                            @if($model->status=='1')
                            <span>  {{$model->notify_msg}}</span>  
                            @else
                            <span>  <b>{{$model->notify_msg}}</b></span>
                            @endif                       
                        </span>
                    </span>
                </a>
                <br/>
                <span class="time">{{\Carbon\Carbon::parse($model->created_at)->format('d F ')}}</span>
            </li>
            
            @endif

            <hr>
        </div>
        
        @endforeach
    </div>
    @CSRF
    @if( $allcount >15)
    <a href="javascript:;" onclick="loadmorenoti();"> <button type="button" class="btn deflt-btn offset-5" id="loadmore">Load More</button></a>
    <input type="hidden" id="row" value="0">
    <input type="hidden" id="all" value="{{ $allcount }}">
    @endif
    @else
    <div class="alert alert-danger text-center" role="alert">
        No notification found!
    </div>
    @endif
</div>

@stop

