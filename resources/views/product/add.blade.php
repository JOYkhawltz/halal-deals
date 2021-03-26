@extends('layouts.main')

@section('css')
<link href="{{ URL::asset('public/frontend/custom/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('content')
<div class="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-3">
                @include('partials.left')
            </div>
            <div class="col-md-10 col-sm-9">
                <form method="post" class="form" action="{{route('add-product')}}" id="add-product-form" enctype="multipart/form-data">
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
                                                <form action="{{ Route('product-photo') }}" method="post" class="dropzone" id="my-dropzone">
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
                                    <label for="usr">Product Name*</label>
                                    <input class="form-control" name="name" type="text" value="">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Product Normal Price*</label>
                                    <input class="form-control" name="normal_price" id="normal_price" type="text" value="">
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
                                    <label for="usr">Type</label>
                                    <select class="form-control" name="type" id="type" onchange="getSubtype(this);">
                                        <option value="">Choose One Product Type</option>
                                        @forelse($types as $type)
                                        <?php
                                        $pType=App\ProductType::where('id',$type)->first();
                                        ?>
                                        <option value="{{$pType->id}}" data-id="{{$pType->id}}">{{$pType->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6" id="subtype">
                            </div> 
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Discount (in %)</label>
                                    <select class="form-control" name="discount_id" id="discount" onchange="getdiscountprice();">
                                        <option value="" >Choose Discount Percentage</option>
                                        @foreach($discounts as $value)
                                        <option value="{{$value->id}}">{{$value->discount_rate}} %</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6" id="dicount_price">
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
                        @if(!empty($data->commission_type) && $data->commission_type == 2)
                        <input type="hidden" name="commission_type" value="{{$data->commission_type}}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Commercial Rate* (in %)</label>
                                    <input type="text" name="commission_rate" class="form-control" value="" placeholder="Enter Commercial Rate">
                                    <span class="help-block"></span> 
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="form-group">
                            <div class="frm-btn text-center">
                                <button class="deflt-btn" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
                @dashFooter @enddashFooter
            </div>
        </div>
        <div class="clearfix"></div>
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
@endsection
