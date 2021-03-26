@extends('layouts.main')

@section('content')
<div class="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-3 tab_dsh_1">
                @include('partials.left')
            </div>
            <div class="col-md-10 col-sm-9 tab_dsh_2">
                <div class="dash-right-sec">
                    <h2 class="dash-title">Notifications</h2>
                    @if(count($models)>0)
                    <div id="loadnoti">
                    @foreach($models as $model)
                    <div class="success alert-success text-center" role="success" >
                        @if($model->type=='1')
                        <i class="icofont-ui-user"></i>
                        @elseif($model->type=='2')
                        <i class="icofont-cart-alt"></i>
                        @elseif($model->type=='3')
                        <i class="icofont-history"></i>
                        @elseif($model->type=='4')
                        <i class="icofont-pay"></i>
                        @elseif($model->type=='5')
                        <i class="icofont-ui-rating"></i>
                        @elseif($model->type=='6')
                        <i class="icofont-box"></i>
                        @elseif($model->type=='7')
                        <i class="icofont-ticket"></i>
                        @elseif($model->type=='8')
                        <i class="icofont-ticket"></i>
                        @elseif($model->type=='9')
                        <i class="icofont-wallet"></i>
                        @endif
                        &nbsp;&nbsp;
                        @if($model->status=='1')
                        <a href="{{Route('read-notification',['id'=>$model->id])}}">{{$model->notify_msg}}</a>
                        @else
                        <a href="{{Route('read-notification',['id'=>$model->id])}}"> <b>{{$model->notify_msg}}</b></a>
                        @endif  
                        <br/>
                        {{\Carbon\Carbon::parse($model->created_at)->format('d F Y')}}
                        <hr>
                    </div>
                    @endforeach
                    </div>
                    @CSRF
                    @if( $allcount >5)
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
                @dashFooter @enddashFooter
            </div>
        </div>
    </div>
</div>
@stop

