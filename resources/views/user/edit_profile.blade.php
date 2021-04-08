@extends('layouts.main')
@section('css')
<link rel="stylesheet" href="{{URL::asset('public/frontend/custom/datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
@endsection
@section('content')
<div class="dashboard">
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-3 tab_dsh_1">
                @include('partials.left')
            </div>
            <div class="col-md-10 col-sm-9 tab_dsh_2">
                <div class="dash-right-sec">
                    <h2 class="dash-title">My Profile</h2>
                    <form method="post" class="form" action="{{route('post-myprofile')}}" id="customer-editprofile-form" enctype="multipart/form-data">
                        @csrf
                        <div class="prof-img" style="text-align: center;padding-bottom: 13px;">
                            <img id="blah" src="{{($model->image!='')? URL::asset('public/uploads/frontend/profile_picture/preview').'/'.$model->image:URL::asset('public/frontend/images/default-pic.jpeg') }}" alt="your image" height="70px" width="70px" />
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">First Name*</label>
                                    <input class="form-control" name="first_name" type="text" value="{{$model->first_name}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Last Name*</label>
                                    <input class="form-control" name="last_name" type="text" value="{{$model->last_name}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Email*</label>
                                    <input class="form-control" name="email" type="email"  value="{{$model->email}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Phone*</label>
                                    <input class="form-control" name="phone" type="text"  value="{{$model->phone}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        @if($model->type_id==='4')
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Title</label>
                                    <input class="form-control" name="title" type="text"  value="{{$model->title}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">DOB</label>
                                    <input class="form-control datepicker" name="dob" type="text" readonly="true" value="{{$model->dob}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="usr">Image</label>
                                    <input class="form-control" name="image" type="file" onchange="readURL(this);" accept="image/png, image/jpeg, image/jpg">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Address 1*</label>
                                    <textarea class="form-control" name="address1_cust" type="text">{{$model->address1}}</textarea>
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Address 2</label>
                                    <textarea class="form-control" name="address2_cust" type="text">{{$model->address2}}</textarea>
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Country* </label>
                                    <select class="form-control" name="country">
                                        <option value="">Select Country</option>
                                        @foreach($country as $value)
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                    <span class="help-block"></span> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Town* </label>
                                    <input class="form-control" name="town_cust" type="text"  value="{{$model->town}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">City* </label>
                                    <input class="form-control" name="city_cust" type="text"  value="{{$model->city}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Postal Code* </label>
                                    <input class="form-control" name="post_code_cust" type="text"  value="{{$model->post_code}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        @elseif($model->type_id==='3')
                        <hr>
                        <b><u>About Your Business:</u></b>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Business Name*</label>
                                    <input class="form-control" name="name" type="text"  value="{{$business->name}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Image</label>
                                    <input class="form-control" name="image" type="file" onchange="readURL(this);" accept="image/png, image/jpeg, image/jpg">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Address 1*</label>
                                    <textarea class="form-control" name="address1" type="text">{{$business->address1}}</textarea>
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Address 2</label>
                                    <textarea class="form-control" name="address2" type="text">{{$business->address2}}</textarea>
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Town </label>
                                    <input class="form-control" name="town" type="text"  value="{{$business->town}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">City*</label>
                                    <input class="form-control" name="city" type="text"  value="{{$business->city}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Postal Code*</label>
                                    <input class="form-control" name="post_code" type="text"  value="{{$business->post_code}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Telephone No</label>
                                    <input class="form-control" name="telphone_no" type="text"  value="{{$business->telphone_no}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Website</label>
                                    <input class="form-control" name="website" type="text"  value="{{$business->website}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div>
                        </div>     
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Halal Certification*</label>
                                    <select class="form-control" name="halal_cert">
                                        <option value="">Select a Halal Cert</option>
                                        <option value="1" {{($business->halal_cert==1)?"selected":""}}>HMC Approved</option>
                                        <option value="2" {{($business->halal_cert==2)?"selected":""}}>HFA Approved</option>
                                        <option value="3" {{($business->halal_cert==3)?"selected":""}}>Other Certification</option>
                                        <option value="4" {{($business->halal_cert==4)?"selected":""}}>No Certification but fully halal</option>
                                        <option value="5" {{($business->halal_cert==5)?"selected":""}}>Non halal meat also served</option>
                                        <option value="6" {{($business->halal_cert==6)?"selected":""}}>Halal upon request only-predominantly non halal meat served</option>
                                        <option value="7" {{($business->halal_cert==7)?"selected":""}}>N/A</option>
                                    </select>
                                    <span class="help-block"></span> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Is alcohol served?*</label>
                                    <select class="form-control" name="alchohol_served">
                                        <option value="">Select an Alcohol Served</option>
                                        <option value="1" {{($business->alchohol_served==1)?"selected":""}}>Yes</option>
                                        <option value="2" {{($business->alchohol_served==2)?"selected":""}}>No</option>
                                        <option value="3" {{($business->alchohol_served==3)?"selected":""}}>Byob Allowed</option>
                                        <option value="4" {{($business->alchohol_served==4)?"selected":""}}>N/A</option>
                                    </select>
                                    <span class="help-block"></span> 
                                </div>
                            </div>  
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Do you offer a male only service?*</label>
                                    <select class="form-control" name="male_service">
                                        <option value="">Select a Male Service</option>
                                        <option value="1" {{($business->male_service==1)?"selected":""}}>Male Only</option>
                                        <option value="2" {{($business->male_service==2)?"selected":""}}>Upon Request</option>
                                        <option value="3" {{($business->male_service==3)?"selected":""}}>Mixed Group Service</option>
                                        <option value="4" {{($business->male_service==4)?"selected":""}}>No Guarantee</option>
                                        <option value="5" {{($business->male_service==5)?"selected":""}}>N/A</option>
                                    </select>
                                    <span class="help-block"></span> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Do you offer a female only service?*</label>
                                    <select class="form-control" name="female_service">
                                        <option value="">Select a Female Service</option>
                                        <option value="1" {{($business->female_service==1)?"selected":""}}>Female Only</option>
                                        <option value="2" {{($business->female_service==2)?"selected":""}}>Upon Request</option>
                                        <option value="3" {{($business->female_service==3)?"selected":""}}>Mixed Group Service</option>
                                        <option value="4" {{($business->female_service==4)?"selected":""}}>No Guarantee</option>
                                        <option value="5" {{($business->female_service==5)?"selected":""}}>N/A</option>
                                    </select>
                                    <span class="help-block"></span> 
                                </div>
                            </div>  
                        </div> 
                        <div class="row">
                            
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Do you have gender segregated areas?*</label>
                                    <select class="form-control" name="gender_segregated">
                                        <option value="">Select a Gender Segregated</option>
                                        <option value="1" {{($business->gender_segregated==1)?"selected":""}}>Yes</option>
                                        <option value="2" {{($business->gender_segregated==2)?"selected":""}}>Upon Request</option>
                                        <option value="3" {{($business->gender_segregated==3)?"selected":""}}>No</option>
                                        <option value="4" {{($business->gender_segregated==5)?"selected":""}}>N/A</option>
                                    </select>
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Do you have areas dedicated for families?*</label>
                                    <select class="form-control" name="family_area">
                                        <option value="">Select a Family Area</option>
                                        <option value="1" {{($business->family_area==1)?"selected":""}}>Yes</option>
                                        <option value="2" {{($business->family_area==2)?"selected":""}}>Upon Request</option>
                                        <option value="3" {{($business->family_area==3)?"selected":""}}>No</option>
                                        <option value="4" {{($business->family_area==5)?"selected":""}}>N/A</option>
                                    </select>
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div> 
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="usr">Introduction</label>
                                    <textarea class="form-control" name="introduction" type="text" placeholder="Please enter some brief information about your business. Approx 3 sentences.">{{$business->introduction}}</textarea>
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="usr">Details</label>
                                    <textarea class="form-control" name="details" type="text" placeholder=" Please enter a more detailed description here.">{{$business->details}}</textarea>
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="usr">Small Print</label>
                                    <textarea class="form-control" name="smallprint" type="text" placeholder="Please enter any terms and conditions for your business here. This will appear on all of your adverts.">{{$business->smallprint}}</textarea>
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <hr>
                        @if(count($product_types)>0)
                        <label>Product Type* :</label>
                        <div class="row cat-menu">
                            @foreach($product_types as $product_type)
                            <div class="col-sm-3 tree">
                                <ul>
                                    <li>
                                        <span class="main_cat">
                                            <i id="plus" class="icofont-plus-square" style="display: inline-block;"></i>
                                            <i id="minus" class="icofont-minus-square" style="display: none;"></i>
                                        </span>
                                        @php
                                        $user_type=explode(",",$business->prod_types);
                                        @endphp
                                        <label>
                                            <input class="main_type" name="prod_types[]" type="checkbox" value="{{$product_type->id}}" {{(in_array($product_type->id,$user_type))?"checked":""}}> {{$product_type->name}}
                                        </label>
                                        @php
                                        $product_sub_types = \App\ProductSubType::where(['parent_id'=>$product_type->id,'status'=>'1'])->get();
                                        $user_subtype=explode(",",$business->prod_sub_types);
                                        @endphp
                                        @if(count($product_sub_types)>0)
                                        <ul class="sub-cat">
                                            @foreach($product_sub_types as $product_sub_type)
                                            <li>
                                                <label>
                                                    <input class="sub_type" name="prod_sub_types[]" type="checkbox" value="{{$product_sub_type->id}}" {{(in_array($product_sub_type->id,$user_subtype))?"checked":""}}> {{$product_sub_type->name}}
                                                </label>
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                            @endforeach
                            <span class="help-block" id="error_productType" style="color: red"></span>
                        </div>
                        @endif
                        <hr>
                        <b><u>Contact Details for us:</u></b>
                        <hr>
                        <div class="row">
                          <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Contact Name:*</label>
                                    <input class="form-control" name="contact_name" type="text"  value="{{$business->contact_name}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Contact No:*</label>
                                    <input class="form-control" name="contact_no" type="text"  value="{{$business->contact_no}}">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        @endif
                        <div class="form-group mt-3 mb-3">
                            <div class="frm-btn text-center"><button class="deflt-btn" type="submit">Submit</button></div>
                        </div>
                    </form>
                    <!--Password form start -->
                    <h2 class="dash-title">Change Password</h2>
                    <form method="post" class="form" action="{{route('post-reset-password')}}" id="reset-password-frm">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Old Password*</label>
                                    <input class="form-control" name="old_password" type="password">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">New Password*</label>
                                    <input class="form-control" name="password" type="password">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="usr">Confirm Password*</label>
                                    <input class="form-control" name="retype_password" type="password">
                                    <span class="help-block"></span> 
                                </div>
                            </div> 
                        </div>
                        <div class="form-group">
                            <div class="frm-btn text-center"><button class="deflt-btn" type="submit">Submit</button></div>
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
        
        $('.datepicker').datetimepicker({
            format: "dd-mm-yyyy",
            autoclose: true,
            todayBtn: true,
            minView: 2
        });
    });
</script>
@endsection
