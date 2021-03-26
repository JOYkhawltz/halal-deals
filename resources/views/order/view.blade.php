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
                    <h2 class="dash-title"><div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-eye font-green-haze"></i>
                                <span class="caption-subject font-green-haze bold uppercase">Viewing details of orders</span>
                            </div>
                        </div></h2>
                    <div class="dash-top-grid">


                        <!-- BEGIN FORM-->
                        <form class="form-horizontal">
                            <div class="form-body nw_form">

                                <div class="row">

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Order Number:</label>

                                            <p class="form-control-static"> 
                                                {{(isset($address->order_number)) ?$address->order_number: "#" }}
                                            </p>

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Customer Name:</label>

                                            <?php
                                            $user = App\User::where('id', '=', $model->user_id)->first();
                                            ?>
                                            <p class="form-control-static">{{$user->first_name.' '.$user->last_name}} </p>

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Item type:</label>

                                            <p class="form-control-static"> 
                                                {{$model->type}}
                                            </p>

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Address:</label>

                                            <p class="form-control-static"> 
                                                {{$address->address.','.$address->city.','.$country->name}}
                                            </p>

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Price:</label>

                                            <p class="form-control-static"><i class="fa fa-gbp" aria-hidden="true"></i> {{ (isset($model->item_price) && $model->item_price !==NULL) ? $model->item_price*$model->quantity:0.00 }} </p>

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Quantity:</label>

                                            <p class="form-control-static">{{$model->quantity}} </p>

                                        </div>
                                    </div>
                                    @if($model->type=='voucher')
                                    <?php
                                    $advert = App\Advert::where('advert_ID', '=', $model->advert_id)->first();
                                    $interval = $advert->voucher_expiry;
                                    $P_day = date('Y-m-d',strtotime($model->created_at));
                                    $end_date = date('d F, Y', strtotime($P_day . ' + ' . $interval . ' day'));
                                    // $voucher_ids=$model->voucher_id;
                                    // $voucher_id=explode(',',$voucher_ids);
                                    // foreach ($voucher_id as $key => $value) { 
                                    //     $voucher_dedailes=App\VoucherDetail::where('id','=',$value)->first();
                                    ?>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Voucher Expired Date:</label>

                                            <p class="form-control-static">{{$end_date}} </p>

                                        </div>
                                    </div>
                                    @endif
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Order placed on:</label>

                                            <p class="form-control-static"><span class="time">{{\Carbon\Carbon::parse($model->created_at)->format('d F Y')}}</span></p>

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Status:</label>

                                            <p class="form-control-static">
                                                @if ($model->status === '0') 
                                                <span class="badge badge-warning">Processing</span>
                                                @elseif ($model->status === '1') 
                                                <span class="badge badge-info">Order Placed</span>
                                                @elseif ($model->status === '2') 
                                                <span class="badge badge-success">Shipped</span>
                                                @elseif ($model->status === '3') 
                                                <span class="badge badge-success">Delivered</span>
                                                @elseif ($model->status === '4') 
                                                <span class="badge badge-danger">Canceled</span>
                                                @else 
                                                <span class="badge badge-danger">Cancel</span>
                                                @endif
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>
                        <!-- END FORM-->

                    </div>
                </div>
                @dashFooter @enddashFooter
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@stop