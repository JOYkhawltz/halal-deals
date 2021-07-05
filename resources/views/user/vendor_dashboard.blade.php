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
                    <h2 class="dash-title">Dashboard</h2>
                    <div class="dash-top-grid row">
                        <div class="col-md-3 col-sm-6">
                            <div class="dash-top-grid-box">
                                <div class="dash-top-grid-box-content">
                                    <div class="dash-top-box-icon"><img src="{{ URL::asset('public/frontend/images/voucher.png') }}" /></div>
                                    <h4>{{$total_deal}}</h4>
                                    <a href="{{Route('get-advert-deal-list')}}"><h5>Live Adverts</h5></a>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-sm-6">
                            <div class="dash-top-grid-box">
                                <div class="dash-top-grid-box-content">
                                    <div class="dash-top-box-icon"><img src="{{ URL::asset('public/frontend/images/box.png') }}" /></div>
                                    <h4>{{$total_product}}</h4>
                                    <a href="{{Route('get-product-list')}}"><h5>Current products</h5></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="dash-top-grid-box">
                                <div class="dash-top-grid-box-content">
                                    <div class="dash-top-box-icon"><img src="{{ URL::asset('public/frontend/images/voucher-(1).png') }}" /></div>
                                    <!-- <h4>{{$total_sold_deal}}</h4> -->
                                    <h4>{{$total_voucher}}</h4>
                                    <a href="{{Route('get-advert-voucher-list')}}"><h5>Vouchers Sold this month</h5></a>
                                </div>
                            </div>
                        </div>

                       <!--
                        
                        <div class="col-md-3 col-sm-6">
                            <div class="dash-top-grid-box">
                                <div class="dash-top-grid-box-content">
                                    <div class="dash-top-box-icon"><img src="{{ URL::asset('public/frontend/images/line-chart.png') }}" /></div>
                                    <h4>{{$total_gs}}</h4>
                                    <h5>Gross Sales This Month</h5>
                                </div>
                            </div>
                        </div>-->
                        <?php
                        $total_gs = 0;
                        foreach ($gross_sales as $gs) {
                            if ($gs->type == 'deal') {
                                $advert = App\Advert::where('advert_ID', $gs->advert_id)->first();
                                $total_gs = $total_gs + ($gs->quantity *$advert->cost_price);
                            } 
                        }
                        ?>
                        <div class="clearfix"></div>
                    </div>
                    @php
                    $years=range(date('Y'),2019);
                    @endphp
                   
                    
                    <div class="vendor-chart-sec row">
                        <div class="col-md-6 col-sm-6">
                            <div class="chart-box">
                                <div class="chart-title">
                                    <h4>Item Sold Per Month</h4>
                                </div>
                                <select name="year" onchange="totalsellsChart(this);">
                                    @forelse($years as $year)
                                    <option value="{{$year}}">{{$year}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <div class="chart-div">
                                    <div id="leadchartContainer" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="chart-box">
                                <div class="chart-title">
                                    <h4>Sales in Pounds</h4>
                                </div>
                              <select name="year" onchange="profitpermonth(this);">
                                    @forelse($years as $year)
                                    <option value="{{$year}}">{{$year}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <div class="chart-div">
                                    <div id="profitPerMonth" style="width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                @dashFooter @enddashFooter
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
@stop

@section('js')
<script src="{{ URL::asset('public/frontend/js/core.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/frontend/js/charts.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/frontend/js/animated.js') }}" type="text/javascript"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/5.0.7/highcharts.js"></script>
<script>
                $(document).ready(function () {
                    totalsellsChart();
                    profitpermonth();
                });
</script>
@stop