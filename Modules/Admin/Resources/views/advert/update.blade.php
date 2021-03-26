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
<li> <a href="{{ Route('admin-viewadvert', ['id' => $model->advert_ID]) }}">{{ $model->title}}</a></li>
<li class="active">Update</li>
@stop
@section('content')      
<div class="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-9">
                <div class="dash-right-sec">

                    <form method="post" class="form" action="{{route('admin-post-editadvert')}}" id="add-product-advert-form" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="prod_ID" value="{{$model->advert_ID}}">
                        <input type="hidden" name="vendor_id" id="vendor_id" value="{{$model->bus_ID}}">
                        <input type="hidden" name="advert_type" id="advert_type" value="{{$model->advert_type}}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr"><b>Advert Type:</b></label>
                                    <div>{{$model->advert_type}}</div>                                                                      
                                </div>
                            </div>
                            <div class="col-sm-6 {{($model->advert_type=='voucher')?'':'hide'}}" id="voucher_expiry">
                                <div class="form-group">
                                    <label for="usr">Voucher Expiry Date(In Days)</label>
                                    <input class="form-control" name="v_exp_date" type="text" value="{{$model->voucher_expiry}}"> 
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Choose Product</label>
                                    <select class="form-control" name="prod_ID" id="prod_ID" onchange="changePrice(this)">
                                        <option value="">Choose One Product</option>
                                        @forelse($products as $product)
                                        <option value="{{$product->prod_ID}}" data-id="{{$product->prod_ID}}" data-price="{{$product->normal_price}}" {{($model->prod_ID==$product->prod_ID)?'selected':''}}>{{$product->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <span class="help-block"></span> 
                                </div>
                            </div>
                            <div class="col-sm-6" id="normal-productprice">
                                <div class="form-group">
                                    <label for="usr"><strong>Normal Price</strong></label>
                                    <p>${{number_format($model->product->normal_price,2)}}</p>
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Advert Title</label>
                                    <input class="form-control" name="title" type="text" value="{{$model->title}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
<!--                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Date Start</label>
                                    <input class="form-control datepicker" name="date_start" type="text" readonly="true" value="{{Carbon\Carbon::parse($model->date_start)->format('d-m-Y')}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Date Finish</label>
                                    <input class="form-control datepicker" name="date_finish" type="text" readonly="true" value="{{Carbon\Carbon::parse($model->date_finish)->format('d-m-Y')}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div>
                        </div>-->
                        <div class="row {{($model->advert_type=='deal')?'':'hide'}}" id="deal">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Deal Start</label>
                                    <input class="form-control datepicker" name="deal_start" type="text" readonly="true" value="{{Carbon\Carbon::parse($model->deal_start)->format('d-m-Y')}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Deal Finish</label>
                                    <input class="form-control datepicker" name="deal_end" type="text" readonly="true" value="{{Carbon\Carbon::parse($model->deal_end)->format('d-m-Y')}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Small Print</label>
                                    <textarea class="form-control" name="smallprint" type="text">{{$model->smallprint}}</textarea>
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" style="padding-right: 26px;">Other Options Available</label>
                                    <input type="checkbox" name="other_options_available" class="other_options_available_checkbox"  value="1" {{($model->other_options_available==='1')?'checked':''}}>Yes
                                    <input type="checkbox" name="other_options_available"  class="other_options_available_checkbox" value="2" {{($model->other_options_available==='2')?'checked':''}}>No
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" style="padding-right: 26px;">Specific times</label>
                                    <input type="checkbox" name="spec_times" class="spec_times_checkbox" value="1" {{($model->spec_times==='1')?'checked':''}}>Yes
                                    <input type="checkbox" name="spec_times" class="spec_times_checkbox"  value="2" {{($model->spec_times==='2')?'checked':''}}>No
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
                                    <input type="checkbox" name="new_cust_only" class="new_cust_only_checkbox" value="1" {{($model->new_cust_only==='1')?'checked':''}}>Yes
                                    <input type="checkbox" name="new_cust_only" class="new_cust_only_checkbox" value="2" {{($model->new_cust_only==='2')?'checked':''}}>No
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" style="padding-right: 26px;">Reservation Request Immediate</label>
                                    <input type="checkbox" name="reservation_request_immediate" class="reservation_request_immediate_checkbox" value="1" {{($model->reservation_request_immediate==='1')?'checked':''}}>Yes
                                    <input type="checkbox" name="reservation_request_immediate" class="reservation_request_immediate_checkbox"  value="2" {{($model->reservation_request_immediate==='2')?'checked':''}}>No
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row" >
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label for="usr">Coupen Discount(%)</label>
                                    <input class="form-control" id="coupen_discount" name="coupen_discount" type="text" value="{{$model->commission_rate}}" onkeyup="discountcoupen(this)">

                                    <span class="help-block" id="help-block_err_coupen"></span>
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group ">
                                    <label for="usr">Additional Discount(%)</label>
                                    <input class="form-control" id="additional_discount" name="additional_discount" value="{{$model->additional_rate}}" onkeyup="additionaldiscount(this);" type="text" >
                                    <span class="help-block" id="help-block_err_addtionalcoupen"></span> 
                                </div>
                            </div>
                        </div>
                        <div class="row " id="output_price">
                            <div class="col-sm-6" >
                                <div class="form-group">
                                    <label for="usr"><strong>Cost Price</strong></label>
                                    <p id="cost_price">${{number_format($model->cost_price,2)}}</p>
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr"><strong>HD Price</strong></label>
                                    <p id="hd_price">${{number_format($model->hd_price,2)}}</p>
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
    </div>
</div>
@stop
@section('js')
<script src="{{URL::asset('public/frontend/custom/datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
@if($model->spec_times ==='1')
<script>
                                        $('#spec_time_details').html('<div class="form-group"><label for="usr" style="padding-right: 26px;">Specific time Detail</label><input type="text" name="spec_times_details" class="form-control" value="{{$model->spec_times_details}}"><span class="help-block"></span></div>');
</script>
@endif
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
                $('#spec_time_details').html('<div class="form-group"><label for="usr" style="padding-right: 26px;">Specific time Detail</label><input type="text" name="spec_times_details" value="{{$model->spec_times_details}}" class="form-control"><span class="help-block"></span></div>');
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
