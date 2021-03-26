@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{URL::asset('public/frontend/custom/datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
@endsection

@section('content')
<div class="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-3">
                @include('partials.left')
            </div>
            <div class="col-md-10 col-sm-9">
                <div class="dash-right-sec">
                    <h2 class="dash-title">Add Advert</h2>
                    <form method="post" class="form" action="{{route('add-advert')}}" id="add-product-advert-form" enctype="multipart/form-data">
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
                            <div class="col-sm-6 d-none" id="voucher_expiry">
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
                                    <label for="usr">Choose Product</label>
                                    <select class="form-control" name="prod_ID" id="prod_ID" onchange="changePrice(this);">
                                        <option value="">Choose One Product</option>
                                        @forelse($products as $product)
                                        <option value="{{$product->prod_ID}}" data-id="{{$product->prod_ID}}" data-price="{{$product->normal_price}}">{{$product->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
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
<!--                        <div class="row " >
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
                        <div class="row d-none" id="deal">
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
                                <div class="form-group has-error">
                                    <label for="usr">Coupen Discount(%)</label>
                                    <input class="form-control" id="coupen_discount" name="coupen_discount" type="text" onkeyup="discountcoupen(this)">

                                    <span class="help-block" id="help-block_err_coupen"></span>
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group has-error">
                                    <label for="usr">Additional Discount(%)</label>
                                    <input class="form-control" id="additional_discount" name="additional_discount" onkeyup="additionaldiscount(this);" type="text" >
                                    <span class="help-block" id="help-block_err_addtionalcoupen"></span> 
                                </div>
                            </div>
                        </div>
                        <div class="row d-none" id="output_price">
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
                    </form>
                </div>
                @dashFooter @enddashFooter
            </div>
        </div>
        <div class="clearfix"></div>
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
