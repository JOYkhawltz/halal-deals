@extends('admin::layouts.main')
@section('css')
<link rel="stylesheet" href="{{ URL::asset('public/frontend/custom/dropzone/dropzone.css') }}" />
<link rel="stylesheet" href="{{ URL::asset('public/frontend/css/dashboard.css')}}" />
<style>
    .custom-control {
        position: relative;
        display: block;
        min-height: 1.5rem;
        padding-left: 1.5rem;
    }
    .custom-control-input {
        position: absolute;
        z-index: -1;
        opacity: 0;
    }
    .custom-checkbox .custom-control-label::before {
        border-radius: .25rem;
    }
    .custom-control-label::before {
        border: 1px solid #000;
        border-radius: 0;
        background: #fcf9f0;
    }
    .custom-control-label::before {
        position: absolute;
        top: .25rem;
        left: 0;
        display: block;
        width: 1rem;
        height: 1rem;
        pointer-events: none;
        content: "";
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: #dee2e6;
    }
    .custom-control-label::after {
        border-radius: 0;
    }
    .custom-control-label::after {
        position: absolute;
        top: .25rem;
        left: 0;
        display: block;
        width: 1rem;
        height: 1rem;
        content: "";
        background-repeat: no-repeat;
        background-position: center center;
        background-size: 50% 50%;
    }
    .custom-checkbox .custom-control-input:checked~.custom-control-label::after {
        background-image:url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3E%3Cpath fill='%23fff' d='M6.564.75l-3.59 3.612-1.538-1.55L0 4.26 2.974 7.25 8 2.193z'/%3E%3C/svg%3E");
    }
    .row{margin: 0;}
    .form .form-row-seperated .form-group { padding: 10px 15px;}

</style>
@endsection

@section('breadcrumb')
<li> <a href="{{ Route('admin-adverts') }}">Adverts</a></li>
<li class="active">Add</li>
@stop

@section('content')
<div class="products-update">
    <div class="portlet light bordered">
        <div class="portlet-body form">
            <form method="post" class="form" action="{{route('admin-addadvert')}}" id="add-product-advert-form" enctype="multipart/form-data">
                <div class="dash-right-sec">
                    <h2 class="dash-title">Add Advert</h2>
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr">Advert Type</label>
                                <select class="form-control" name="advert_type" id="advert_type" onchange="adverttype(this);">
                                    <option value="">Choose One Advert type</option>                          
                                    <option value="deal">Deal</option>
                                    <option value="voucher">Voucher</option>
                                </select>
                                <span class="help-block"></span> 
                            </div>
                        </div>
                        <div class="col-sm-6 hide" id="voucher_expiry">
                            <div class="form-group">
                                <label for="usr">Voucher Expiry Date(In Days)</label>
                                <input class="form-control" name="v_exp_date" type="text">
                                <span class="help-block"></span> 
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr">Choose Vendor *</label>
                                <select class="form-control" name="vendor_id" onchange="getproduct(this)">
                                    <option value="">Please choose a vendor</option>
                                    @forelse($vendors as $user)
                                    <option value="{{$user->business->bus_ID}}" data-id="{{$user->business->bus_ID}}">{{$user->first_name.' '.$user->last_name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <span class="help-block"></span> 
                            </div>
                        </div> 
                    </div>
                    <div class="row hide" id="product">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr">Choose Product</label>
                                <div id="product_list"></div>
                                <span class="help-block"></span> 
                            </div>
                        </div>
                        <div class="col-sm-6" id="normal-productprice">
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr">Advert Title</label>
                                <input class="form-control" name="title" type="text">
                                <span class="help-block"></span> 
                            </div>
                        </div> 
                    </div>
                    <!--                    <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="usr">Date Start</label>
                                                    <input class="form-control datepicker" name="date_start" type="text" readonly="true">
                                                    <span class="help-block"></span> 
                                                </div>
                                            </div> 
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="usr">Date Finish</label>
                                                    <input class="form-control datepicker" name="date_finish" type="text" readonly="true">
                                                    <span class="help-block"></span> 
                                                </div>
                                            </div>
                                        </div>-->
                    <div class="row hide" id="deal">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr">Deal Start</label>
                                <input class="form-control datepicker" name="deal_start" type="text" readonly="true">
                                <span class="help-block"></span> 
                            </div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr">Deal Finish</label>
                                <input class="form-control datepicker" name="deal_end" type="text" readonly="true">
                                <span class="help-block"></span> 
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr">Small Print</label>
                                <textarea class="form-control" name="smallprint" type="text"></textarea>
                                <span class="help-block"></span> 
                            </div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr" style="padding-right: 26px;">Other Options Available</label>
                                <input type="checkbox" name="other_options_available" class="other_options_available_checkbox"  value="1">Yes
                                <input type="checkbox" name="other_options_available" class="other_options_available_checkbox" value="2">No
                                <span class="help-block"></span> 
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr" style="padding-right: 26px;">Specific times</label>
                                <input type="checkbox" name="spec_times" class="spec_times_checkbox" value="1">Yes
                                <input type="checkbox" name="spec_times" class="spec_times_checkbox"  value="2">No
                                <span class="help-block"></span> 
                            </div>
                        </div> 
                        <div class="col-sm-6" id="spec_time_details">
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr" style="padding-right: 26px;">New Customer Only</label>
                                <input type="checkbox" name="new_cust_only" class="new_cust_only_checkbox" value="1">Yes
                                <input type="checkbox" name="new_cust_only" class="new_cust_only_checkbox" value="2">No
                                <span class="help-block"></span> 
                            </div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr" style="padding-right: 26px;">Reservation Request Immediate</label>
                                <input type="checkbox" name="reservation_request_immediate" class="reservation_request_immediate_checkbox" value="1">Yes
                                <input type="checkbox" name="reservation_request_immediate" class="reservation_request_immediate_checkbox" value="2">No
                                <span class="help-block"></span> 
                            </div>
                        </div> 
                    </div>
                    <div class="row" >
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="usr">Coupen Discount(%)</label>
                                <input class="form-control" id="coupen_discount" name="coupen_discount" type="text" onkeyup="discountcoupen(this)">

                                <span class="help-block" id="help-block_err_coupen"></span>
                            </div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group ">
                                <label for="usr">Additional Discount(%)</label>
                                <input class="form-control" id="additional_discount" name="additional_discount" onkeyup="additionaldiscount(this);" type="text" >
                                <span class="help-block" id="help-block_err_addtionalcoupen"></span> 
                            </div>
                        </div>
                    </div>
                    <div class="row hide" id="output_price">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr"><strong>Cost Price</strong></label>
                                <p id="cost_price">$0.00</p>
                                <span class="help-block"></span> 
                            </div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr"><strong>HD Price</strong></label>
                                <p id="hd_price">$0.00</p>
                                <span class="help-block"></span> 
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="frm-btn text-center">
                            <button class="deflt-btn" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
@section('js')
<script src="{{URL::asset('public/frontend/custom/datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script>
                                    $(document).ready(function () {


                                        $('.datepicker').datetimepicker({
                                            format: "dd-mm-yyyy",
                                            autoclose: true,
                                            todayBtn: true,
                                            startDate: new Date(),
                                            minView: 2
                                        });
                                        $('input.spec_times_checkbox').on('change', function () {
                                            if ($(this).prop('checked') === true && $(this).val() === '1') {
                                                $('#spec_time_details').html('<div class="form-group"><label for="usr" style="padding-right: 26px;">Specific time Detail</label><input type="text" name="spec_times_details" class="form-control"><span class="help-block"></span></div>');
                                            } else {
                                                $('#spec_time_details').html('');
                                            }
                                            $('input.spec_times_checkbox').not(this).prop('checked', false);
                                        });
                                        $('input.other_options_available_checkbox').on('change', function () {
                                            $('input.other_options_available_checkbox').not(this).prop('checked', false);
                                        });
                                        $('input.new_cust_only_checkbox').on('change', function () {
                                            $('input.new_cust_only_checkbox').not(this).prop('checked', false);
                                        });
                                        $('input.reservation_request_immediate_checkbox').on('change', function () {
                                            $('input.reservation_request_immediate_checkbox').not(this).prop('checked', false);
                                        });
                                    });
</script>
@endsection
