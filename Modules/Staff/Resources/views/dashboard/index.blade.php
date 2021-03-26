@extends('staff::layouts.main')

@section('breadcrumb')
<li class="active">Dashboard</li>
@stop

@section('content')
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="{{ $total_vendors }}">0</span>
                    </h3>
                    <small>TOTAL ASSIGNED VENDOR</small>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="status">
                    <div class="status-title"> vendor </div>
                    <a href="{{Route('staff-vendor.index')}}" class="status-number"> VIEW </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="{{ $total_products }}">0</span>
                    </h3>
                    <small>TOTAL PRODUCTS</small>
                </div>
                <div class="icon">
                    <i class="icon-equalizer"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="status">
                    <div class="status-title"> product </div>
                    <a href="{{Route('staff-products')}}" class="status-number"> VIEW </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="{{$total_advert}}">{{$total_advert}}</span>
                    </h3>
                    <small>TOTAL ADVERTS</small>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="status">
                    <div class="status-title"> adverts </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="{{$total_voucher}}">{{$total_voucher}}</span>
                    </h3>
                    <small>TOTAL VOUCHERS</small>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="status">
                    <div class="status-title"> Voucher </div>
                    <a href="{{ Route('staff-voucher-adverts') }}" class="status-number"> VIEW </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="{{$total_deal}}">{{$total_deal}}</span>
                    </h3>
                    <small>TOTAL DEALS</small>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="status">
                    <div class="status-title"> Deal</div>
                    <a href="{{ Route('staff-deal-adverts') }}" class="status-number"> VIEW </a>
                </div>
            </div>
        </div>
    </div>
</div>
@stop