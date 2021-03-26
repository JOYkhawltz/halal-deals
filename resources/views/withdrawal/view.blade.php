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
                                <span class="caption-subject font-green-haze bold uppercase">Viewing details of withdrawls</span>
                            </div>
                        </div></h2>
                    <div class="dash-top-grid">


                        <!-- BEGIN FORM-->
                        <form class="form-horizontal">
                            <div class="form-body nw_form">

                                <div class="row">

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Withdrawl Amount:</label>

                                            <p class="form-control-static"> 
                                                <i class="fa fa-gbp" aria-hidden="true"></i>{{$withdrawl->amount}}
                                            </p>

                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Bank Name:</label>

                                           
                                            <p class="form-control-static">{{$withdrawl->bank_name}} </p>

                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Bank Holder Name:</label>

                                           
                                            <p class="form-control-static">{{$withdrawl->account_holder_name}} </p>

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Account Number:</label>

                                            <p class="form-control-static"> 
                                                {{$withdrawl->account_number}}
                                            </p>

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Branch Name:</label>

                                            <p class="form-control-static"> 
                                                {{$withdrawl->branch_name}}
                                            </p>

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">IFSC Code:</label>

                                            <p class="form-control-static"> {{ $withdrawl->ifsc_code}} </p>

                                        </div>
                                    </div>

                                    @if(isset($address->micr_code))
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">MICR code:</label>

                                            <p class="form-control-static">{{$withdrawl->micr_code}} </p>

                                        </div>
                                    </div>
                                    @endif

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Withdrawl Date:</label>

                                            <p class="form-control-static"><span class="time">{{\Carbon\Carbon::parse($withdrawl->created_at)->format('d F Y')}}</span></p>

                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="control-label">Status:</label>

                                            <p class="form-control-static">
                                                @if ($withdrawl->status === '0') 
                                                <span class="badge badge-warning">Pending</span>
                                                @else 
                                                <span class="badge badge-success">Paid</span>
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