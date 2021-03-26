@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-orders') }}">orders</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Viewing details of orders</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal">
            <div class="form-body">

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Order ID:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->order_id)) ?$model->order_id : "#" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Order Number:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($address->order_number)) ?$address->order_number: "#" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Customer Name:</label>
                            <div class="col-md-9">
                                <?php
                                $user = App\User::where('id', '=', $model->user_id)->first();
                                ?>
                                <p class="form-control-static">{{$user->first_name.' '.$user->last_name}} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Item type:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> 
                                    {{$model->type}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Address:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> 
                                    {{$address->address.','.$address->city.','.$country->name}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Price:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><i class="fa fa-gbp" aria-hidden="true"></i> {{ (isset($model->item_price) && $model->item_price !==NULL) ? $model->item_price*$model->quantity:0.00 }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Quantity:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{$model->quantity}} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Order placed on:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><span class="time">{{\Carbon\Carbon::parse($model->created_at)->format('d F Y')}}</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Status:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    @if ($model->status === '0') 
                                    <span class="text text-warning">Processing</span>
                                    @elseif ($model->status === '1') 
                                    <span class="text text-info">Order Placed</span>
                                    @elseif ($model->status === '2') 
                                    <span class="text text-success">Shipped</span>
                                    @elseif ($model->status === '3') 
                                    <span class="text text-success">Delivered</span>
                                    @elseif ($model->status === '4') 
                                    <span class="text text-danger">Canceled</span>
                                    @else 
                                    <span class="text text-danger">Cancel</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </form>
        <!-- END FORM-->
    </div>
</div>
@stop