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
<li> <a href="{{ Route('admin-products') }}">Products</a></li>
<li> <a href="{{ Route('admin-viewproduct', ['id' => $model->prod_ID]) }}">{{ $model->name}}</a></li>
<li class="active">Update</li>
@stop
@section('content')      
<div class="dash-body">
    <div class="common-table-sec add-product-sec">
        <form  method="post" action="{{Route('admin-updateproduct',['id'=>$model->prod_ID])}}" id="add-product-form" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <input type="hidden" name="AllImages[is_default]" id="is_default" value="0">
                <div class="product-image"></div>
                <div class="image_upload_div" style="display: none;">
                    <form action="" method="post" class="dropzone" id="my-dropzone">
                        @csrf
                    </form>
                </div>
                <div class="col-sm-12 form-group">
                    <div class="dash-block grey-bg">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="usr">Images*</label>
                                <div class="image_upload_div">
                                    <form action="{{ Route('admin-product-photos') }}" method="post" class="dropzone" id="my-dropzone">
                                        @csrf
                                    </form>
                                </div>
                                <span class="help-block" id="error_image"></span>
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
                            <input class="form-control" name="normal_price" id="normal_price" type="text" value="{{$model->normal_price}}">
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
                            <label for="usr">SubTypes</label>
                            <select class="form-control" name="sub_type" id="sub_type">
                                <option value="">Choose One Product SubType</option>
                                <?php
                                $subtypes = App\ProductSubType::where('parent_id', $model->type)->get();
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
                                    <input type="text" class="form-control" placeholder="No Discount Provided" id="discount" value="{{(!empty($discounts)) ? $discounts->discount_rate : ''}}" readonly>
                                    <input type="hidden" name="discount_id" id="discount_id" value="{{(!empty($discounts)) ? $discounts->id : ''}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6" id="dicount_price" {{($model->discount_id != "") ? "" : 'style=display:none' }}>
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
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="usr">Price Verified : </label>
                            <input type="radio" name="price_verified" value="1" {{($model->price_verified==='1')?"checked":""}} />Yes
                            <input type="radio" name="price_verified" value="2" {{($model->price_verified==='2')?"checked":""}} />NO
                            <span class="help-block"></span> 
                        </div>
                    </div> 
<!--                     <div class="col-sm-6">
                        <div class="form-group">
                            <label>Status :</label>
                            <input type="radio" name="status" value="1" {{($model->status==='1')?"checked":""}} />Active
                            <input type="radio" name="status" value="0" {{($model->status==='0')?"checked":""}} />Inactive
                            <span class="help-block"></span> 
                        </div>
                    </div>  -->
                </div>
                <!-- <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="usr"><strong>Commission Type : </strong></label>
                            <input type="radio" name="commission_type" value="1" {{($model->commission_type==='1')?"checked":""}} />Commission
                            <input type="radio" name="commission_type" value="2" {{($model->commission_type==='2')?"checked":""}} />Commercial Rate
                            <span class="help-block"></span>
                        </div>
                    </div> 
                    <div class="col-sm-3  ">
                        <div class="form-group">
                            <label for="usr"><strong>Commission Rate (%) :</strong></label>
                            <input type="text" name="commission_rate" class="form-control" value="{{(old('commission_rate'))?old('commission_rate'): number_format($model->commission_rate,2)}}">
                            <span class="help-block"></span>
                        </div>
                    </div> 
                    <div class="col-sm-3  ">
                        <div class="form-group">
                            <label for="usr"><strong>Additional Rate (%):</strong></label>
                            <input type="text" name="additional_rate" class="form-control" value="{{(old('additional_rate'))?old('additional_rate'):number_format($model->additional_rate,2)}}">

                        </div>
                    </div> 
                </div> -->
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
                <div class="form-btn col-lg-12 text-center"><button type="submit">Submit</button></div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ URL::asset('public/frontend/custom/dropzone/dropzone.js') }}"></script>
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
    $(document).ready(function () {
        var a = 0;
        Dropzone.options.myDropzone = {
            init: function () {
                thisDropzone = this;
                if (a == 0) {
                    var csrf_token = $('input[name=_token]').val();
                    $.ajax({
                        headers: {'X-CSRF-TOKEN': csrf_token},
                        type: 'GET',
                        url: full_path + 'admin-showphotos',
                        data: {id: '<?= $model->prod_ID; ?>'},
                        dataType: 'json',
                        success: function (data) {
                            if (data.res == 1) {
                                $.each(data.images, function (key, value) {
                                    var mockFile = {name: value.name, size: value.size};
                                    thisDropzone.options.addedfile.call(thisDropzone, mockFile);
                                    thisDropzone.options.thumbnail.call(thisDropzone, mockFile, (full_path + '../public/uploads/frontend/product/preview/') + value.name);
                                    thisDropzone.emit("complete", mockFile);
                                    var html = '<input type="hidden" name="AllImages[image][]" id="image_' + key + '" value=' + value.name + '>';
                                    $('.product-image').append(html);
                                    if (value.is_default == 1) {
                                        $('#img_' + key).attr("checked", true);
                                        $('#side_img_' + key).prop("checked", false).attr('disabled', true);
                                        $('#is_default').val(key);
                                    }
                                    if (value.is_side == 1) {
                                        $('#side_img_' + key).attr("checked", true);
                                        $('.product-images').append('<input type="hidden" name="AllImages[is_side][]" id="is_side_' + key + '" value="' + key + '">');
                                    }
                                });
                            }
                        }
                    });
                    a = 1;
                }
            }
        };
    });
</script>
@stop