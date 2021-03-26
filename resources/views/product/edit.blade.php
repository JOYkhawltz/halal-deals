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
                <form method="post" class="form" action="{{route('post-edit-product')}}" id="add-product-form" enctype="multipart/form-data">
                    <div class="dash-right-sec">
                        <h2 class="dash-title">Edit Product of {{$model->name}}</h2>
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id"  value="{{$model->prod_ID}}">
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
                                    <input class="form-control" name="name" type="text" value="{{$model->name}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Product Normal Price*</label>
                                    <input class="form-control" name="normal_price" type="text" id="normal_price" value="{{$model->normal_price}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Brief Description</label>
                                    <textarea class="form-control" name="brief_description" type="text">{{$model->brief_description}}</textarea>
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Detailed Description</label>
                                    <textarea class="form-control" name="detailed_description" type="text">{{$model->detailed_description}}</textarea>
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
                                    <label for="usr">Actual Deal</label>
                                    <textarea class="form-control" name="actual_deal" type="text">{{$model->actual_deal}}</textarea>
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
                                        $pType = App\ProductType::where('id', $type)->first();
                                        ?>
                                        <option value="{{$pType->id}}" data-id="{{$pType->id}}" {{($model->type==$pType->id)?'selected':''}} >{{$pType->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6" id="subtype">
                                <div class="form-group">
                                    <label for="usr">SubType</label>
                                    <select class="form-control" name="sub_type" id="sub_type">
                                        <option value="">Choose One Product SubType</option>
                                        <?php
                                        $subtypes = App\ProductSubType::where('parent_id',$model->type)->get();
                                        ?>
                                        @forelse($subtypes as $subtype)
                                        <option value="{{$subtype->id}}" data-id="{{$subtype->id}}" {{($model->sub_type==$subtype->id)?'selected':''}}>{{$subtype->name}}</option>
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
                                    <label for="usr">Discount (in %)</label>
                                    <select class="form-control" name="discount_id" id="discount" onchange="getdiscountprice();">
                                        <option value="" >Choose Discount Percentage</option>
                                        @foreach($discounts as $value)
                                        <option value="{{$value->id}}" {{($model->discount_id != "" && $model->discount_id == $value->id)?'selected':''}}>{{$value->discount_rate}} %</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6 {{($model->discount_id != '') ? '' : 'd-none' }}" id="dicount_price" >
                                <label for="usr">New Discounted Price</label>
                                <input type="number" class="form-control" name="discount_price" value="{{$model->discount_price}}" readonly>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Address Required :</label>
                                    <input type="checkbox" name="address_required" class="address-required-checkbox" value="1" {{($model->address_required==='1')?'checked':''}}>Yes
                                    <input type="checkbox" name="address_required" class="address-required-checkbox" value="2" {{($model->address_required==='2')?'checked':''}}>No
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6" id="address-required-div">

                            </div> 
                        </div>
                        @if(!empty($model->commission_type) && $model->commission_type == 2)
                        <input type="hidden" name="commission_type" value="{{$model->commission_type}}">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Commercial Rate* (in %)</label>
                                    <input type="text" name="commission_rate" class="form-control" value="{{$model->commission_rate}}" placeholder="Enter Commercial Rate">
                                    <span class="help-block"></span> 
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr"><strong>Price Verified : </strong></label>
                                    <p>
                                        @if($model->price_verified==='1')
                                        Yes
                                        @else
                                        NO
                                        @endif
                                    </p>
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Status :</label>
                                    <input type="radio" name="status" value="1" {{($model->status==='1')?"checked":""}} />Active
                                    <input type="radio" name="status" value="0" {{($model->status==='0')?"checked":""}} />Inactive
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="form-btn col-lg-12 text-center">  <button class="deflt-btn" type="submit">Submit</button></div>
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
@if($model->address_required==='1')
<script>
                                        $('#address-required-div').html('<div class="form-group"><label for="usr">Postage Cost*</label><input class="form-control" name="postage_cost" type="text" value="{{$model->postage_cost}}"><span class="help-block"></span></div>');
</script>
@endif
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
    var a = 0;
    Dropzone.options.myDropzone = {
        init: function () {
            thisDropzone = this;
            if (a == 0) {
                var csrf_token = $('input[name=_token]').val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': csrf_token},
                    type: 'GET',
                    url: '{{route("show-images")}}',
                    data: {id: '<?= $model->prod_ID; ?>'},
                    dataType: 'json',
                    success: function (data) {
                        if (data.res == 1) {
                            $.each(data.images, function (key, value) {
                                var mockFile = {name: value.name, size: value.size};
                                thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                                thisDropzone.options.thumbnail.call(thisDropzone, mockFile, (full_path + '/public/uploads/frontend/product/preview/') + value.name);
                                thisDropzone.emit("complete", mockFile);
                                var html = '<input type="hidden" name="AllImages[image][]" id="image_' + key + '" value=' + value.name + '>';
                                $('.product-image').append(html);
                                if (value.is_default == 1) {
                                    $('#img_' + key).attr("checked", true);
                                    $('#side_img_' + key).prop("checked", false).attr('disabled', true);
                                    $('#is_default').val(key);
                                }
                            });
                        }
                    }
                });
                a = 1;
            }
        }
    };
</script>
@endsection
