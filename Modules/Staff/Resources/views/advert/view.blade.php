@extends('staff::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('staff-adverts') }}">Adverts</a></li>
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
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Advert ID:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->advert_ID)) ?$model->advert_ID : "#" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Advert Type:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->advert_type)) ?$model->advert_type : "#" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Associate Product:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($product->name)) ? $product->name : 'unknown' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Cost Price:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><i class="fa fa-usd"></i>{{ (isset($model->cost_price) && $model->cost_price !==NULL) ? $model->cost_price :0.00 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">HD Price:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><i class="fa fa-usd"></i>{{ (isset($model->hd_price) && $model->hd_price !==NULL) ? $model->hd_price :0.00 }} </p>
                            </div>
                        </div>
                    </div>
                </div>
<!--                @if($model->date_start!==NULL)
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Date Start:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{ (isset($model->date_start) && $model->date_start !==NULL) ? Carbon\Carbon::parse($model->date_start)->format('d F Y') :'Not Known'  }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($model->date_finish!==NULL)
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Date Finish:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{ (isset($model->date_finish) && $model->date_finish !==NULL) ? Carbon\Carbon::parse($model->date_finish)->format('d F Y') :'Not Known' }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif-->
                @if($model->deal_start!==NULL)
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Deal Start:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{ (isset($model->deal_start) && $model->deal_start !==NULL) ? Carbon\Carbon::parse($model->deal_start)->format('d F Y') :'Not Known' }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($model->deal_end!==NULL)
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Deal End:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{ (isset($model->deal_end) && $model->deal_end !==NULL) ? Carbon\Carbon::parse($model->deal_end)->format('d F Y') :'Not Known' }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @if($model->voucher_expiry!==NULL)
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Voucher Expired IN:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->voucher_expiry)) ? $model->voucher_expiry : 'Not Applicable' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Status:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    @if($model->status == '0')
                                    <span class="text text-warning">Inactive</span>
                                    @elseif($model->status == '1')
                                    <span class="text text-success">Active</span>
                                    @else
                                    <span class="text text-danger">Delete</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions text-right">
                <a href="{{ Route('staff-updateadvert', ['ID' => $model->advert_ID]) }}" class="btn green">
                    <i class="fa fa-pencil"></i> Edit
                </a>
                <a href="{{ Route('staff-adverts') }}" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
@stop