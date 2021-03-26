@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{URL::asset('public/frontend/custom/datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
@endsection

@section('content')
<div class="dashboard .dashboard_nav">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-3">
                @include('partials.left')
            </div>
            <div class="col-md-10 col-sm-9">
                <div class="dash-right-sec">
                    <h2 class="dash-title">Add Voucher</h2>
                    <form method="post" class="form" action="{{route('add-advert-voucher')}}" id="add-product-advert-form" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 " >
                                <div class="form-group">
                                    <label for="usr">Voucher Amount</label>
                                    <input class="form-control" name="v_amount" type="text">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6 ">
                                <div class="form-group">
                                    <label for="usr">Total Voucher</label>
                                    <input class="form-control" name="total_voucher" type="text">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-6 " >
                                <div class="form-group">
                                    <label for="usr">Voucher Expiry (In Days)</label>
                                    <input class="form-control" name="voucher_expiery" type="text">
                                    <span class="help-block"></span> 
                                </div>
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
                        <div class="row">
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
                                    <label for="usr">Choose Additional</label>
                                    <select class="form-control" name="additional"  onchange="Additional(this);">
                                        <option value="">Choose Additional</option>                          
                                        <option value="spctime">Specific times</option>
                                        <option value="newcstmer">New Customer Only</option>
                                    </select>
                                    <span class="help-block"></span> 
                                </div>
                            </div>
                        </div>
                        <div class="row d-none" id="spctime">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" style="padding-right: 26px;">Specific times</label>
                                    <input type="checkbox" name="spec_times" class="spec_times_checkbox" value="1">Yes
                                    <input type="checkbox" name="spec_times" class="spec_times_checkbox"  value="2">No
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row d-none" id="additonalspctime">
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
                        </div>
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
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr" style="padding-right: 26px;">Reservation Request Immediate</label>
                                    <input type="checkbox" name="reservation_request_immediate" class="reservation_request_immediate_checkbox" value="1">Yes
                                    <input type="checkbox" name="reservation_request_immediate" class="reservation_request_immediate_checkbox" value="2">No
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
    @dashFooter @enddashFooter
</div>
@stop
@section('js')
<script src="{{URL::asset('public/frontend/custom/datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script>
                                        $(document).ready(function () {


                                            $('.datepicker').datetimepicker({
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
