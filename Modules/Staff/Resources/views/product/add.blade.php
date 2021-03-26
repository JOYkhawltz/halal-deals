@extends('staff::layouts.main')

@section('css')
<link href="{{ URL::asset('public/frontend/custom/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
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
    .dz-preview .default-img-txt {
        position: absolute;
        top: -25px;
        left: 20px;
    }
    .dz-preview .img-radio{
        position: absolute;
        top: -22px;
        left: 0;
    }
</style>
@endsection

@section('breadcrumb')
<li> <a href="{{ Route('staff-products') }}">Products</a></li>
<li class="active">Add</li>
@stop

@section('content')
<div class="products-update">
    <div class="portlet light bordered">
        <div class="portlet-body form">
            <form method="post" class="form" action="{{route('staff-addproduct')}}" id="add-product-form" enctype="multipart/form-data">
                <div class="dash-right-sec">
                    <h2 class="dash-title">Add Product</h2>
                    @csrf
                    <input type="hidden" name="AllImages[is_default]" id="is_default" value="0">
                    <div class="product-image"></div>
                    <div class="image_upload_div" style="display: none;">
                        <form action="" method="post" class="dropzone" id="my-dropzone">
                            @csrf
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <div class="dash-block grey-bg">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="usr">Images*</label>
                                        <div class="image_upload_div">
                                            <form action="{{ Route('staff-product-photos') }}" method="post" class="dropzone" id="my-dropzone">
                                                @csrf
                                            </form>
                                        </div>
                                        <span class="help-block" id="error_image"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr">Choose Vendor *</label>
                                <select class="form-control" name="vendor_id">
                                    <option value="">Please choose a vendor</option>
                                    @forelse($vendors as $user)
                                    <option value="{{$user->business->bus_ID}}">{{$user->first_name.' '.$user->last_name}}</option>
                                    @empty
                                    @endforelse
                                </select>
                                <span class="help-block"></span> 
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr">Product Name*</label>
                                <input class="form-control" name="name" type="text" value="">
                                <span class="help-block"></span> 
                            </div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr">Product Normal Price*</label>
                                <input class="form-control" name="normal_price" type="text" value="">
                                <span class="help-block"></span> 
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr">Brief Description</label>
                                <textarea class="form-control" name="brief_description" type="text"></textarea>
                                <span class="help-block"></span> 
                            </div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr">Detailed Description</label>
                                <textarea class="form-control" name="detailed_description" type="text"></textarea>
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
                                <label for="usr">Actual Deal</label>
                                <textarea class="form-control" name="actual_deal" type="text"></textarea>
                                <span class="help-block"></span> 
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="usr">Address Required*</label>
                                <input type="checkbox" name="address_required" class="address-required-checkbox" value="1">Yes
                                <input type="checkbox" name="address_required" class="address-required-checkbox" value="2">No
                                <span class="help-block"></span> 
                            </div>
                        </div> 
                        <div class="col-sm-6" id="address-required-div">

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
<script src="{{ URL::asset('public/frontend/custom/dropzone/dropzone.js') }}" type="text/javascript"></script>
<script>
    $(document).ready(function () {
        $('input.address-required-checkbox').on('change', function () {
            if ($(this).prop('checked') === true && $(this).val() === '1') {
                $('#address-required-div').html('<div class="form-group"><label for="usr">Postage Cost*</label><input class="form-control" name="postage_cost" type="text"><span class="help-block"></span></div>');
            } else {
                $('#address-required-div').html('');
            }
            $('input.address-required-checkbox').not(this).prop('checked', false);
        });
    });
</script>
@stop