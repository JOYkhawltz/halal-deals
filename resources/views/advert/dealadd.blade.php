@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{URL::asset('public/frontend/custom/datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
@endsection

@section('content')
<div class="dashboard ">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-3">
                @include('partials.left')
            </div>
            <div class="col-md-10 col-sm-9">
                <div class="dash-right-sec">
                    <h2 class="dash-title">Add Advert</h2>
                    <form method="post" class="form" action="{{route('add-advert-deal')}}" id="add-product-advert-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Choose Product</label>
                                    <select class="form-control" name="prod_ID" id="prod_ID" onchange="changeprice(this);">
                                        <option value="">Choose One Product</option>
                                        @forelse($products as $product)
                                        <option value="{{$product->prod_ID}}" data-id="{{$product->prod_ID}}" data-price="{{$product->normal_price}}" data-discount-price="{{($product->discount_price == '') ? '' : $product->discount_price}}">{{$product->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <span class="help-block"></span> 
                                </div>
                            </div>
                            <div class="col-sm-3" id="normal-productprice">
                            </div>
                            <div class="col-sm-3" id="discount-productprice">
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
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Embeded youtube video url</label>
                                    <input class="form-control" name="youtube_url" type="text">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row " id="deal">
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
                                    <span class="mr-2">
                                    <input type="checkbox" name="other_options_available" class="other_options_available_checkbox"  value="1">Yes
                                    </span>
                                    <input type="checkbox" name="other_options_available" class="other_options_available_checkbox" value="2">No
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Choose Additional :</label><br><br>
                                    <label for="usr" style="padding-right: 26px;">a) New Customer Only</label>
                                    <input type="checkbox" name="new_cust_only" class="new_cust_only_checkbox" value="1">Yes
                                    <input type="checkbox" name="new_cust_only" class="new_cust_only_checkbox" value="2">No
                                    <br><br> 
                                    <label for="usr" style="padding-right: 26px;">b) Specific times</label>
                                    <input type="checkbox" name="spec_times" class="spec_times_checkbox" value="1">Yes
                                    <input type="checkbox" name="spec_times" class="spec_times_checkbox"  value="2">No
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Postage allow &nbsp;</label>
                                    <input type="checkbox" name="postage_allow" class="postage_checkbox" value="1">
                                    <span class="help-block"></span> 
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row d-none" id="spctime">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" style="padding-right: 26px;">Specific times</label>
                                    <input type="checkbox" name="spec_times" class="spec_times_checkbox" value="1">Yes
                                    <input type="checkbox" name="spec_times" class="spec_times_checkbox"  value="2">No
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div> -->
                        <div class="row d-none" id="additonalspctime">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Days</label>
                                    <input class="form-control" name="date_start" type="text" >
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Times</label>
                                    <input class="form-control" name="date_finish" type="text" >
                                    <span class="help-block"></span> 
                                </div>
                            </div>
                        </div>
                        <!-- <div class="dash_hgt">
                        <div class="row d-none" id="newcstmer">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" style="padding-right: 26px;">New Customer Only</label>
                                    <input type="checkbox" name="new_cust_only" class="new_cust_only_checkbox" value="1">Yes
                                    <input type="checkbox" name="new_cust_only" class="new_cust_only_checkbox" value="2">No
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        </div> --> 
                       <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" style="padding-right: 26px;">Reservation Request Immediate</label>
                                    <span class="mr-2">
                                    <input type="checkbox" name="reservation_request_immediate" class="reservation_request_immediate_checkbox" value="1">Yes
                                    </span>
                                    <input type="checkbox" name="reservation_request_immediate" class="reservation_request_immediate_checkbox" value="2">No
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" style="padding-right: 26px;">In hot offers</label>
                                    <span class="mr-2">
                                    <input type="checkbox" name="hot_offer" class="hotoffer__checkbox" value="1">
                                    </span>
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row d-none" id="commission_type_check">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" style="padding-right: 26px;">Addition Rate(in %)</label>
                                    <input class="form-control" name="additional_rate" type="text" >
                                    <span class="help-block"></span> 
                                    <span class="help-block"></span> 
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
                
            </div>
        </div>
        <div class="clearfix"></div>
        @dashFooter @enddashFooter
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
                                            $('.datepickertime').datetimepicker({
                                                format: "dd-mm-yyyy hh:ii",
                                                autoclose: true,
                                                startDate: new Date(),
                                                time:true
                                            });
                                            $('input.spec_times_checkbox').on('change', function () {
                                                if ($(this).prop('checked') === true && $(this).val() === '1') {
                                                    $('#additonalspctime').removeClass('d-none');
                                                } else {
                                                    $('#additonalspctime').addClass('d-none');
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
