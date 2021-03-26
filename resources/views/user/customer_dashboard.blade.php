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
                                    <div class="dash-top-box-icon"><img src="{{ URL::asset('public/frontend/images/box.png') }}" /></div>
                                    <h4>{{$total_deal}}</h4>
                                    <h5>Total Deal purchase</h5>
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

