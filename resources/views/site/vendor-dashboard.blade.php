@extends('layouts.main')


@section('content')
        <div class="dashboard">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 col-sm-3">
                        <div class="dash-left-menu">
                            <ul>
                                <li class="active"><a href="#"><i class="icofont-rocket"></i>Dashboard</a></li>
                                <li><a href="#"><i class="icofont-ticket"></i>Coupons</a></li>
                                <li><a href="#"><i class="icofont-box"></i>Products</a></li>
                                <li><a href="#"><i class="icofont-ui-user"></i>My Account</a></li>
								<li><a href="#"><i class="icofont-notification"></i>Notification</a></li>
                                <li><a href="#"><i class="icofont-logout"></i>Log Out</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-10 col-sm-9">
                        <div class="dash-right-sec">
                            <h2 class="dash-title">Dashboard</h2>
                            <div class="dash-top-grid row">
                                <div class="col-md-3 col-sm-6">
                                    <div class="dash-top-grid-box">
                                        <div class="dash-top-grid-box-content">
                                            <div class="dash-top-box-icon"><img src="{{ URL::asset('public/frontend/images/voucher.png') }}" /></div>
                                            <h4>2368</h4>
                                            <h5>Total Coupons</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="dash-top-grid-box">
                                        <div class="dash-top-grid-box-content">
                                            <div class="dash-top-box-icon"><img src="{{ URL::asset('public/frontend/images/box.png') }}" /></div>
                                            <h4>746</h4>
                                            <h5>Total Products</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="dash-top-grid-box">
                                        <div class="dash-top-grid-box-content">
                                            <div class="dash-top-box-icon"><img src="{{ URL::asset('public/frontend/images/voucher-(1).png') }}" /></div>
                                            <h4>142</h4>
                                            <h5>Coupons Sold This Month</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                    <div class="dash-top-grid-box">
                                        <div class="dash-top-grid-box-content">
                                            <div class="dash-top-box-icon"><img src="{{ URL::asset('public/frontend/images/line-chart.png') }}" /></div>
                                            <h4>328</h4>
                                            <h5>Gross Sales This Month</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="vendor-chart-sec row">
                                <div class="col-md-6 col-sm-6">
                                    <div class="chart-box">
                                        <div class="chart-title">
                                            <h4>Coupon Sold Per Month</h4>
                                        </div>
                                        <div class="chart-div">
                                            <div id="soldPerMonth" class="chart-size"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="chart-box">
                                        <div class="chart-title">
                                            <h4>Total Profit Per Month</h4>
                                        </div>
                                        <div class="chart-div">
                                            <div id="profitPerMonth" class="chart-size"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="dash-footer">
                            <p>© Copyright Halal-Deals. All Rights Reserved.</p>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
   @stop

@section('js')
<script src="{{ URL::asset('public/frontend/js/owl.carousel.min.js') }}" type="text/javascript"></script>

    <script type="text/javascript">
        // Themes begin for sold per month
        am4core.useTheme(am4themes_animated);
// Create chart instance
        var chart = am4core.create("soldPerMonth", am4charts.XYChart);

// Add data
        chart.data = [{
                "country": "Jan",
                "visits": 3025
            }, {
                "country": "Feb",
                "visits": 1882
            }, {
                "country": "Mar",
                "visits": 1809
            }, {
                "country": "Apr",
                "visits": 1322
            }, {
                "country": "May",
                "visits": 1122
            }, {
                "country": "Jun",
                "visits": 1114
            }, {
                "country": "Jul",
                "visits": 984
            }, {
                "country": "Aug",
                "visits": 711
            }, {
                "country": "Sep",
                "visits": 665
            }, {
                "country": "Oct",
                "visits": 580
            }, {
                "country": "Nov",
                "visits": 443
            }, {
                "country": "Dec",
                "visits": 441
            }];

// Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "country";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;
        categoryAxis.renderer.labels.template.horizontalCenter = "right";
        categoryAxis.renderer.labels.template.verticalCenter = "middle";
        categoryAxis.renderer.labels.template.rotation = 270;
        categoryAxis.tooltip.disabled = true;
        categoryAxis.renderer.minHeight = 110;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.minWidth = 50;

// Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.sequencedInterpolation = true;
        series.dataFields.valueY = "visits";
        series.dataFields.categoryX = "country";
        series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
        series.columns.template.strokeWidth = 0;

        series.tooltip.pointerOrientation = "vertical";

        series.columns.template.column.cornerRadiusTopLeft = 10;
        series.columns.template.column.cornerRadiusTopRight = 10;
        series.columns.template.column.fillOpacity = 0.8;

// on hover, make corner radiuses bigger
        var hoverState = series.columns.template.column.states.create("hover");
        hoverState.properties.cornerRadiusTopLeft = 0;
        hoverState.properties.cornerRadiusTopRight = 0;
        hoverState.properties.fillOpacity = 1;

        series.columns.template.adapter.add("fill", function (fill, target) {
            return chart.colors.getIndex(target.dataItem.index);
        });

// Cursor
        chart.cursor = new am4charts.XYCursor();
    </script>
    <script type="text/javascript">
        // Themes begin for sold per month
        am4core.useTheme(am4themes_animated);
// Create chart instance
        var chart = am4core.create("profitPerMonth", am4charts.XYChart);

// Add data
        chart.data = [{
                "country": "Jan",
                "visits": 3025
            }, {
                "country": "Feb",
                "visits": 1882
            }, {
                "country": "Mar",
                "visits": 1809
            }, {
                "country": "Apr",
                "visits": 1322
            }, {
                "country": "May",
                "visits": 1122
            }, {
                "country": "Jun",
                "visits": 1114
            }, {
                "country": "Jul",
                "visits": 984
            }, {
                "country": "Aug",
                "visits": 711
            }, {
                "country": "Sep",
                "visits": 665
            }, {
                "country": "Oct",
                "visits": 580
            }, {
                "country": "Nov",
                "visits": 443
            }, {
                "country": "Dec",
                "visits": 441
            }];

// Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "country";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;
        categoryAxis.renderer.labels.template.horizontalCenter = "right";
        categoryAxis.renderer.labels.template.verticalCenter = "middle";
        categoryAxis.renderer.labels.template.rotation = 270;
        categoryAxis.tooltip.disabled = true;
        categoryAxis.renderer.minHeight = 110;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.renderer.minWidth = 50;

// Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.sequencedInterpolation = true;
        series.dataFields.valueY = "visits";
        series.dataFields.categoryX = "country";
        series.tooltipText = "[{categoryX}: bold]{valueY}[/]";
        series.columns.template.strokeWidth = 0;

        series.tooltip.pointerOrientation = "vertical";

        series.columns.template.column.cornerRadiusTopLeft = 10;
        series.columns.template.column.cornerRadiusTopRight = 10;
        series.columns.template.column.fillOpacity = 0.8;

// on hover, make corner radiuses bigger
        var hoverState = series.columns.template.column.states.create("hover");
        hoverState.properties.cornerRadiusTopLeft = 0;
        hoverState.properties.cornerRadiusTopRight = 0;
        hoverState.properties.fillOpacity = 1;

        series.columns.template.adapter.add("fill", function (fill, target) {
            return chart.colors.getIndex(target.dataItem.index);
        });

// Cursor
        chart.cursor = new am4charts.XYCursor();
    </script>
@stop