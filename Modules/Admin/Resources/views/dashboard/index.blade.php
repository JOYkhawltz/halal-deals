@extends('admin::layouts.main')

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
                        <span data-counter="counterup" data-value="{{ $total_users }}">0</span>
                    </h3>
                    <small>TOTAL USERS</small>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="status">
                    <div class="status-title"> users </div>
                    <!--<a href="#" class="status-number"> VIEW </a>-->
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="{{ $total_customers }}">0</span>
                    </h3>
                    <small>TOTAL CUSTOMERS</small>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="status">
                    <div class="status-title"> users </div>
                    <a href="{{ Route('customer.index') }}" class="status-number"> VIEW </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="{{ $total_business_managers }}">0</span>
                    </h3>
                    <small>TOTAL BUSINESS MANAGERS</small>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="status">
                    <div class="status-title"> users </div>
                    <a href="{{ Route('vendor.index') }}" class="status-number"> VIEW </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="{{ $total_business_admins }}">0</span>
                    </h3>
                    <small>TOTAL HD STAFFS</small>
                </div>
                <div class="icon">
                    <i class="fa fa-users"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="status">
                    <div class="status-title"> users </div>
                    <a href="{{ Route('admin-staff.index') }}" class="status-number"> VIEW </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="{{$total_product}}">{{$total_product}}</span>
                    </h3>
                    <small>TOTAL PRODUCTS</small>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="status">
                    <div class="status-title"> products </div>
                    <a href="{{ Route('admin-products') }}" class="status-number"> VIEW </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="{{$total_product_type}}">{{$total_product_type}}</span>
                    </h3>
                    <small>TOTAL PRODUCTS TYPES</small>
                </div>
                <div class="icon">
                    <i class="fa fa-list"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="status">
                    <div class="status-title"> products types </div>
                    <a href="{{ Route('product-type.index') }}" class="status-number"> VIEW </a>
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
                    <a href="{{ Route('admin-deal-adverts') }}" class="status-number"> VIEW </a>
                </div>
            </div>
        </div>
    </div>
<!--    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
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
                    <a href="{{ Route('admin-voucher-adverts') }}" class="status-number"> VIEW </a>
                </div>
            </div>
        </div>
    </div>-->
    
</div>
<br/>
@php
$years=range(date('Y'),2019);
@endphp
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="dashboard-stat2">
            <div class="common-select">
                <select name="year" onchange="totalsellsChart(this);">
                    @forelse($years as $year)
                    <option value="{{$year}}">{{$year}}</option>
                    @empty
                    @endforelse
                </select>
            </div>
            <div id="leadchartContainer" style="width: 100%;"></div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="dashboard-stat2">
            <div class="common-select">
                <select name="year" onchange="profitpermonth(this);">
                    @forelse($years as $year)
                    <option value="{{$year}}">{{$year}}</option>
                    @empty
                    @endforelse
                </select>
            </div>
            <div id="profitPerMonth" style="width: 100%;"></div>
        </div>
    </div>
</div>
@stop
@section('js')
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/5.0.7/highcharts.js"></script>
<script>
                    $(document).ready(function () {
                        totalsellsChart();
                        profitpermonth();
                    });
</script>
@stop