@extends('staff::layouts.main')

@section('breadcrumb')
<li> <a href="{{ Route('staff-products') }}">Products</a></li>
<li class="active">View</li>
@stop

@section('content')
<div class="portlet light bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="fa fa-eye font-green-haze"></i>
            <span class="caption-subject font-green-haze bold uppercase">Viewing details of {{ $model->name }}</span>
        </div>
    </div>
    <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="form-horizontal">
            <div class="form-body">
                @if(count($model->images))
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group text-center">
                            @foreach($model->images as $image)
                            <img src="{{($image->image_name!==NULL)?URL::asset('public/uploads/frontend/product/preview/'.$image->image_name):URL::asset('public/frontend/images/box.png')}}" height="100px" width="100px" />
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Product ID:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->prod_ID)) ?$model->prod_ID : "#" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Product Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ isset($model->name) ? $model->name : "Unknown" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Creater Name:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> 
                                    @php
                                    $id = $model->business->user_id;
                                    $user = $model->vendor($id);
                                    echo (isset($user->first_name) ? $user->first_name . ' ' . $user->last_name : 'unknown');
                                    @endphp
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Price:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><i class="fa fa-gbp" aria-hidden="true"></i> {{ (isset($model->normal_price) && $model->normal_price !==NULL) ? $model->normal_price :0.00 }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                @if($model->discount_id != '' && $model->discount_price != '')
                @if(!empty($discount_rate))
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Discount Rate:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{ (isset($discount_rate->discount_rate) && $discount_rate->discount_rate !==NULL) ? $discount_rate->discount_rate : 0 }} %</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Discounted Price:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><i class="fa fa-gbp" aria-hidden="true"></i> {{ (isset($model->discount_price) && $model->discount_price !==NULL) ? $model->discount_price : 0.00 }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Price Verified:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{ (isset($model->price_verified) && $model->normal_price==='1') ? 'YES' :'NO' }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                @if($model->price_verified_date!==NULL)
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Price Verified Date:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">{{ (isset($model->price_verified_date) && $model->price_verified_date !==NULL) ? Carbon\Carbon::parse($model->price_verified_date)->format('d F Y') :'Not Known' }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Brief Description:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->brief_description) && $model->brief_description !==NULL) ? $model->brief_description : "N/A" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Detailed Description:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->detailed_description)) ? $model->detailed_description : "N/A" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Small Print:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->smallprint)) ? $model->smallprint : "N/A" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Actual Deal:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->actual_deal)) ? $model->actual_deal : "N/A" }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Address Required:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"> {{ (isset($model->address_required) && $model->address_required==='1') ? 'YES' :'NO' }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                @if($model->postage_cost!==NULL)
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Postage Cost:</label>
                            <div class="col-md-9">
                                <p class="form-control-static"><i class="fa fa-usd"></i>  {{ (isset($model->postage_cost) && $model->postage_cost != null) ? $model->postage_cost : 0.00 }} </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label col-md-3">Status:</label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    @if($model->status == '0')
                                    <span class="text text-warning">Inactive</span>
                                    @elseif($model->status == '1')
                                    <span class="text text-success">Active</span>
                                    @else
                                    <span class="text text-danger">Delete</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions text-right">
                <a href="{{ Route('staff-updateproduct', ['id' => $model->prod_ID]) }}" class="btn green">
                    <i class="fa fa-pencil"></i> Edit
                </a>
                <a href="{{ Route('staff-products') }}" class="btn default">Back</a>
            </div>
        </form>
        <!-- END FORM-->
    </div>
</div>
@stop