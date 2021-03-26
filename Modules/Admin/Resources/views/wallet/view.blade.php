@extends('admin::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('admin-wallet-management') }}">Withdrawl request</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Viewing details of Withdrawl request</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->

        <div class="form-body">
            <form method="post" class="form" action="{{route('admin-addpayment',['id'=>$wallet->id])}}" id="add-payment-form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Vendor Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ $user->first_name . ' ' . $user->last_name}} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Withdrawl Amount:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> <i class="fa fa-gbp" aria-hidden="true"></i>{{ (isset($wallet->amount)) ?$wallet->amount: "0.00" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                @if($wallet->status=='0')
                <div class="form-group">
                    <div class="frm-btn text-center">
                        <button class="deflt-btn" type="submit">Payment</button>
                    </div>
                </div>
                @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Status:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <span class="text text-success">Paid</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </form>
            <h2>Bank Information</h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">Bank Name:</label>
                        <div class="col-md-9">
                            <p class="form-control-static">{{$wallet->bank_name}} </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">Account Holder Name:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> 
                                {{$wallet->account_holder_name}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">Account Number:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> 
                                {{$wallet->account_number}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">Branch Name:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"> {{$wallet->branch_name}} </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">IFSC Code:</label>
                        <div class="col-md-9">
                            <p class="form-control-static">{{$wallet->ifsc_code}}</p>
                        </div>
                    </div>
                </div>
            </div>
            @if(isset($wallet->micr_code))
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label col-md-3">MICR Code:</label>
                        <div class="col-md-9">
                            <p class="form-control-static"><span class="time">{{$wallet->micr_code}}</span></p>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>

        <!-- END FORM-->
    </div>
</div>
@stop