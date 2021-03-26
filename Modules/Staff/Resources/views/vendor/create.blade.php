@extends('staff::layouts.main')

@section('css')
<link href="{{ URL::asset('public/frontend/css/icofont.min.css') }}" rel="stylesheet" type="text/css" /> 
<link href="{{ URL::asset('public/frontend/css/style.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('breadcrumb')
<li> <a href="{{ Route('vendor.index') }}">Vendors</a></li>
<li class="active">Create</li>
@stop

@section('content')
<div class="user-update">
    <div class="portlet light bordered">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-edit font-green-haze" aria-hidden="true"></i>
                <span class="caption-subject font-green-haze bold uppercase">Creating Vendor</span>
            </div>
        </div>
        <div class="portlet-body form">
            <form class="form-horizontal form-row-seperated" action="{{ Route('vendor.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                <label>First Name <span class="required">*</span></label>
                                <input type="text" class="form-control" name="first_name" value="{{ (old('first_name') !== NULL) ? old('first_name') : '' }}" placeholder="First Name">
                                @if ($errors->has('first_name'))
                                <div class="help-block">{{ $errors->first('first_name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                <label>Last Name <span class="required">*</span></label>
                                <input type="text" class="form-control" name="last_name" value="{{ (old('last_name') !== NULL) ? old('last_name') : '' }}" placeholder="Last Name">
                                @if ($errors->has('last_name'))
                                <div class="help-block">{{ $errors->first('last_name') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                                <label>Email <span class="required">*</span></label>
                                <input type="email" class="form-control" name="email" value="{{ (old('email') !== NULL) ? old('email') : '' }}" placeholder="Email">
                                @if ($errors->has('email'))
                                <div class="help-block">{{ $errors->first('email') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                <label>Status <span class="required">*</span></label>
                                <div class="radio-list">
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="1" {{ (old('status')==1) ? "checked" : '' }}> Active
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="status" value="2" {{ (old('status')==2) ? "checked" : '' }}> Suspended
                                    </label>
                                    @if ($errors->has('status'))
                                    <div class="help-block">{{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="usr">Name</label>
                                <input class="form-control" name="name" type="text"  value="{{ (old('name')!==NULL) ? old('name') : '' }}">
                                @if ($errors->has('name'))
                                <div class="help-block">{{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('address1') ? ' has-error' : '' }}">
                                <label for="usr">Address 1</label>
                                <textarea class="form-control" name="address1" type="text" >{{ (old('address1')!==NULL) ? old('address1') : '' }}</textarea>
                                @if ($errors->has('address1'))
                                <div class="help-block">{{ $errors->first('address1') }}</div>
                                @endif
                            </div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('address2') ? ' has-error' : '' }}">
                                <label for="usr">Address 2</label>
                                <textarea class="form-control" name="address2" type="text" >{{ (old('address2')!==NULL) ? old('address2') : '' }}</textarea>
                                @if ($errors->has('address2'))
                                <div class="help-block">{{ $errors->first('address2') }}</div>
                                @endif
                            </div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('town') ? ' has-error' : '' }}">
                                <label for="usr">Town </label>
                                <input class="form-control" name="town" type="text"  value="{{ (old('town')!==NULL) ? old('town') : '' }}">
                                @if ($errors->has('town'))
                                <div class="help-block">{{ $errors->first('town') }}</div>
                                @endif 
                            </div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
                                <label for="usr">City</label>
                                <input class="form-control" name="city" type="text"  value="{{ (old('city')!==NULL) ? old('city') : '' }}">
                                @if ($errors->has('city'))
                                <div class="help-block">{{ $errors->first('city') }}</div>
                                @endif
                            </div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('post_code') ? ' has-error' : '' }}">
                                <label for="usr">Postal Code </label>
                                <input class="form-control" name="post_code" type="number"  value="{{ (old('post_code')!==NULL) ? old('post_code') : '' }}">
                                @if ($errors->has('post_code'))
                                <div class="help-block">{{ $errors->first('post_code') }}</div>
                                @endif
                            </div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('telphone_no') ? ' has-error' : '' }}">
                                <label for="usr">Telephone No</label>
                                <input class="form-control" name="telphone_no" type="text"  value="{{ (old('telphone_no')!==NULL) ? old('telphone_no') : '' }}">
                                @if ($errors->has('telphone_no'))
                                <div class="help-block">{{ $errors->first('telphone_no') }}</div>
                                @endif
                            </div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('website') ? ' has-error' : '' }}">
                                <label for="usr">Website </label>
                                <input class="form-control" name="website" type="text"  value="{{ (old('website')!==NULL) ? old('website') : '' }}">
                                @if ($errors->has('website'))
                                <div class="help-block">{{ $errors->first('website') }}</div>
                                @endif 
                            </div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('contact_name') ? ' has-error' : '' }}">
                                <label for="usr">Contact Name</label>
                                <input class="form-control" name="contact_name" type="text"  value="{{ (old('contact_name')!==NULL) ? old('contact_name') : '' }}">
                                @if ($errors->has('contact_name'))
                                <div class="help-block">{{ $errors->first('contact_name') }}</div>
                                @endif
                            </div>
                        </div> 
                        <div class="col-sm-6 {{ $errors->has('contact_no') ? ' has-error' : '' }}">
                            <div class="form-group">
                                <label for="usr">Contact No</label>
                                <input class="form-control" name="contact_no" type="number"  value="{{ (old('contact_no')!==NULL) ? old('contact_no') : '' }}">
                                @if ($errors->has('contact_no'))
                                <div class="help-block">{{ $errors->first('contact_no') }}</div>
                                @endif
                            </div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('halal_cert') ? ' has-error' : '' }}">
                                <label for="usr">Halal Cert</label>
                                <select class="form-control" name="halal_cert">
                                    <option value="">Select a Halal Cert</option>
                                    <option value="1" {{(old('halal_cert')==1)?"selected":""}}>HMC Approved</option>
                                    <option value="2" {{(old('halal_cert')==2)?"selected":""}}>HFA Approved</option>
                                    <option value="3" {{(old('halal_cert')==3)?"selected":""}}>Other Certification</option>
                                    <option value="4" {{(old('halal_cert')==4)?"selected":""}}>No Certification but fully halal</option>
                                    <option value="5" {{(old('halal_cert')==5)?"selected":""}}>Non halal meat also served</option>
                                    <option value="6" {{(old('halal_cert')==6)?"selected":""}}>Halal upon request only-predominantly non halal meat served</option>
                                    <option value="7" {{(old('halal_cert')==7)?"selected":""}}>N/A</option>
                                </select>
                                @if ($errors->has('halal_cert'))
                                <div class="help-block">{{ $errors->first('halal_cert') }}</div>
                                @endif
                            </div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('alchohol_served') ? ' has-error' : '' }}">
                                <label for="usr">Alcohol Served</label>
                                <select class="form-control" name="alchohol_served">
                                    <option value="">Select an Alcohol Served</option>
                                    <option value="1" {{(old('alchohol_served')==1)?"selected":""}}>Yes</option>
                                    <option value="2" {{(old('alchohol_served')==2)?"selected":""}}>No</option>
                                    <option value="3" {{(old('alchohol_served')==3)?"selected":""}}>Byob Allowed</option>
                                    <option value="4" {{(old('alchohol_served')==4)?"selected":""}}>N/A</option>
                                </select>
                                @if ($errors->has('alchohol_served'))
                                <div class="help-block">{{ $errors->first('alchohol_served') }}</div>
                                @endif 
                            </div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('male_service') ? ' has-error' : '' }}">
                                <label for="usr">Male Service</label>
                                <select class="form-control" name="male_service">
                                    <option value="">Select a Male Service</option>
                                    <option value="1" {{(old('male_service')==1)?"selected":""}}>Male Only</option>
                                    <option value="2" {{(old('male_service')==2)?"selected":""}}>Upon Request</option>
                                    <option value="3" {{(old('male_service')==3)?"selected":""}}>Mixed Group Service</option>
                                    <option value="4" {{(old('male_service')==4)?"selected":""}}>No Guarantee</option>
                                    <option value="5" {{(old('male_service')==5)?"selected":""}}>N/A</option>
                                </select>
                                @if ($errors->has('male_service'))
                                <div class="help-block">{{ $errors->first('male_service') }}</div>
                                @endif 
                            </div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('female_service') ? ' has-error' : '' }}">
                                <label for="usr">Female Service</label>
                                <select class="form-control" name="female_service">
                                    <option value="">Select a Female Service</option>
                                    <option value="1" {{(old('female_service')==1)?"selected":""}}>Female Only</option>
                                    <option value="2" {{(old('female_service')==2)?"selected":""}}>Upon Request</option>
                                    <option value="3" {{(old('female_service')==3)?"selected":""}}>Mixed Group Service</option>
                                    <option value="4" {{(old('female_service')==4)?"selected":""}}>No Guarantee</option>
                                    <option value="5" {{(old('female_service')==5)?"selected":""}}>N/A</option>
                                </select>
                                @if ($errors->has('female_service'))
                                <div class="help-block">{{ $errors->first('female_service') }}</div>
                                @endif
                            </div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('gender_segregated') ? ' has-error' : '' }}">
                                <label for="usr">Gender Segregated</label>
                                <select class="form-control" name="gender_segregated">
                                    <option value="">Select a Gender Segregated</option>
                                    <option value="1" {{(old('gender_segregated')==1)?"selected":""}}>Yes</option>
                                    <option value="2" {{(old('gender_segregated')==2)?"selected":""}}>Upon Request</option>
                                    <option value="3" {{(old('gender_segregated')==3)?"selected":""}}>No</option>
                                    <option value="4" {{(old('gender_segregated')==4)?"selected":""}}>N/A</option>
                                </select>
                                @if ($errors->has('gender_segregated'))
                                <div class="help-block">{{ $errors->first('gender_segregated') }}</div>
                                @endif
                            </div>
                        </div> 
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('family_area') ? ' has-error' : '' }}">
                                <label for="usr">Family Area</label>
                                <select class="form-control" name="family_area">
                                    <option value="">Select a Family Area</option>
                                    <option value="1" {{(old('family_area')==1)?"selected":""}}>Yes</option>
                                    <option value="2" {{(old('family_area')==2)?"selected":""}}>Upon Request</option>
                                    <option value="3" {{(old('family_area')==3)?"selected":""}}>No</option>
                                    <option value="4" {{(old('family_area')==4)?"selected":""}}>N/A</option>
                                </select>
                                @if ($errors->has('family_area'))
                                <div class="help-block">{{ $errors->first('family_area') }}</div>
                                @endif
                            </div>
                        </div> 
                    </div> 
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->has('introduction') ? ' has-error' : '' }}">
                                <label for="usr">Introduction</label>
                                <textarea class="form-control" name="introduction" type="text">{{(old('introduction')!==NULL)?old('introduction'):''}}</textarea>
                                @if ($errors->has('introduction'))
                                <div class="help-block">{{ $errors->first('introduction') }}</div>
                                @endif
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->has('details') ? ' has-error' : '' }}">
                                <label for="usr">Details</label>
                                <textarea class="form-control" name="details" type="text">{{(old('details')!==NULL)?old('details'):''}}</textarea>
                                @if ($errors->has('details'))
                                <div class="help-block">{{ $errors->first('details') }}</div>
                                @endif
                            </div>
                        </div> 
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group {{ $errors->has('smallprint') ? ' has-error' : '' }}">
                                <label for="usr">Small Print</label>
                                <textarea class="form-control" name="smallprint" type="text">{{(old('smallprint')!==NULL)?old('smallprint'):''}}</textarea>
                                @if ($errors->has('smallprint'))
                                <div class="help-block">{{ $errors->first('smallprint') }}</div>
                                @endif
                            </div>
                        </div> 
                    </div>
                    @if(count($product_types)>0)
                    <label>Product Type :</label>
                    <div class="row cat-menu">
                        @foreach($product_types as $product_type)
                        <div class="col-sm-3 tree">
                            <ul>
                                <li>
                                    <span class="main_cat">
                                        <i id="plus" class="icofont-plus-square" style="display: inline-block;"></i>
                                        <i id="minus" class="icofont-minus-square" style="display: none;"></i>
                                    </span>
                                    <label>
                                        <input class="main_type" name="prod_types[]" type="checkbox" value="{{$product_type->id}}"> {{$product_type->name}}
                                    </label>
                                    @php
                                    $product_sub_types = \App\ProductSubType::where(['parent_id'=>$product_type->id,'status'=>'1'])->get();
                                    @endphp
                                    @if(count($product_sub_types)>0)
                                    <ul class="sub-cat">
                                        @foreach($product_sub_types as $product_sub_type)
                                        <li>
                                            <label>
                                                <input class="sub_type" name="prod_sub_types[]" type="checkbox" value="{{$product_sub_type->id}}"> {{$product_sub_type->name}}
                                            </label>
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif
                                </li>
                            </ul>
                        </div>
                        @endforeach
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group {{ $errors->has('hd_staff_link') ? ' has-error' : '' }}">
                                <label for="usr">HD Staff Name :</label>
                                <select class="form-control" name="hd_staff_link">
                                    <option value="">Please select at least one HD staff</option>
                                    @forelse($hd_staff as $staff)
                                    <option value="{{$staff->id}}">{{$staff->first_name.' '.$staff->last_name}}</option>
                                    @empty

                                    @endforelse
                                </select>
                                @if ($errors->has('hd_staff_link'))
                                <div class="help-block">{{ $errors->first('hd_staff_link') }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6">
                            <button type="submit" class="btn green">Create</button>
                            <a href="{{ Route('vendor.index') }}" class="btn default">Back</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    $(document).ready(function () {
        $(".sub-cat").hide();
        $(".main_cat").click(function () {
            $(this).closest("li").find(".sub-cat").toggle(300);
            $(this).find("#plus").toggle();
            $(this).find("#minus").toggle();
        });
        $(document).on('click', '.sub_type', function () {
            var main_sub_ul = $(this).parents("li").parent();
            if ($(this).prop("checked") == true) {
                $(main_sub_ul).parent().find(".main_type").attr('checked', true);
            }
            if ($(main_sub_ul).find('.sub_type:checked').length == 0) {
                $(main_sub_ul).parent().find(".main_type").removeAttr('checked');
            }
        });
    });
</script>
@endsection