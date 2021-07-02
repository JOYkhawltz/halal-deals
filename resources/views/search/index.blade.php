@extends('layouts.main')
@section('css')
<link href="{{ URL::asset('public/frontend/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('content')
<section class="main-body-section">
    <div class="product_list">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-3">
                    <form action="{{Route('post-coupon-search')}}" id="filterCouponForm">
                        @csrf
                        <input type="hidden" id="limit" name="limit" value="{{ $limit }}">
                        <input type="hidden" id="offset" name="offset" value="{{ $offset }}">
                        <input type="hidden" id="sc" name="sc" value="{{$subcategory}}">
                       
                        <div class="left_part">
                            <h1 class="man_heading">Filters</h1>
                            <div class="filter_box">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroupPrepend"><i class="fa fa-search" aria-hidden="true"></i></span>
                                    </div>
                                    <input type="text" class="form-control filterbykeyword" id="validationCustomUsername" name="title" value="{{(isset($title) && $title!==NULL)?$title:''}}" placeholder="Product Name" aria-describedby="inputGroupPrepend">
                                    <div class="invalid-feedback">
                                        Amazon
                                    </div>
                                </div>
                            </div>
                            <div class="filter_box">
                                <h2>Categories</h2>
                                <ul class="cust-scroll-table">
                                    @forelse($categories as $category)
                                    <li>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" name="category[]" class="custom-control-input category-coupon-checkbox" id="check_{{$category->id}}" value="{{$category->id}}" onclick="loadProducts(0);" >
                                            <label class="custom-control-label" for="check_{{$category->id}}">{{$category->name}}</label>
                                        </div>
                                    </li>
                                    @empty
                                    @endforelse
                                </ul>
                                <!--<div class="filter_box">
                                <h2>TEST</h2>
                                <ul class="cust-scroll-table">
                                    @forelse($halals as $key => $value)
                                    <li>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" name="{{$key}}" class="custom-control-input category-coupon-checkbox" id="check_{{$value}}" value="{{$value}}" onclick="loadProducts(0);" >
                                            <label class="custom-control-label" for="check_{{$value}}">{{$key}}</label>
                                        </div>
                                    </li>
                                    @empty
                                    @endforelse
                                </ul>-->
                            </div>
                            
                            <div class="filter_box d-none">
                                <h2>Sub Categories</h2>
                                <ul class="cust-scroll-table"  id="left-fetch-subcategory">
                                    
                                </ul>
                            </div>

                            <div class="filter_box">
                                <h2>Location</h2>
                                <input type="text" class="form-control filterbykeyword" name="town" placeholder="Enter town" value="{{(isset($town) && $town!==NULL)?$town:''}}" required=""><br/>
                                <input type="text" class="form-control filterbykeyword" name="city" placeholder="Enter city" value="{{(isset($city) && $city!==NULL)?$city:''}}" required="" ><br/>
                                <input type="text" class="form-control filterbykeyword" name="post_code" placeholder="Enter postcode" value="{{(isset($postcode) && $postcode!==NULL)?$postcode:''}}" required="" >
                            </div>
                            <div class="filter_box">
                                <h2>Price</h2>
                                <input type="text" class="form-control filterbykeyword " name="min_price" placeholder="Minimumn price" value="{{(isset($min_price) && $min_price!==NULL)?$min_price:''}}" required="" ><br/>
                                <input type="text" class="form-control filterbykeyword" name="max_price" placeholder="Maximum price" value="{{(isset($max_price) && $max_price!==NULL)?$max_price:''}}" required="" >
                            </div>

                            <!--                        <div class="filter_box ">
                                                        <div class="stl_drp">
                                                            <select class="form-control selectpicker" name="[]" >
                                                            </select>
                                                        </div>
                                                    </div>-->
                                                    <!-- JOYEDIT
                                                    <div class="filter_box">
                                <h2>Categories</h2>
                                <ul class="cust-scroll-table" tabindex="5002" style="overflow: hidden; outline: none;">
                                                                        <li>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" name="category[]" class="custom-control-input category-coupon-checkbox" id="check_1" value="1" onclick="loadProducts(0);">
                                            <label class="custom-control-label" for="check_1">Wellbeing</label>
                                        </div>
                                    </li>
                                                                        <li>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" name="category[]" class="custom-control-input category-coupon-checkbox" id="check_2" value="2" onclick="loadProducts(0);">
                                            <label class="custom-control-label" for="check_2">Hotels</label>
                                        </div>
                                    </li>
                                                                        <li>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" name="category[]" class="custom-control-input category-coupon-checkbox" id="check_3" value="3" onclick="loadProducts(0);">
                                            <label class="custom-control-label" for="check_3">Products</label>
                                        </div>
                                    </li>
                                                                        <li>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" name="category[]" class="custom-control-input category-coupon-checkbox" id="check_4" value="4" onclick="loadProducts(0);">
                                            <label class="custom-control-label" for="check_4">Restaurants</label>
                                        </div>
                                    </li>
                                                                        <li>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" name="category[]" class="custom-control-input category-coupon-checkbox" id="check_5" value="5" onclick="loadProducts(0);">
                                            <label class="custom-control-label" for="check_5">Other Services</label>
                                        </div>
                                    </li>
                                                                    </ul>
                            </div>                        
                                                    
                            <div class="filter_box">
                                <div class="stl_drp">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                <input type="checkbox" name="a" class="custom-control-input category-coupon-checkbox"  value="HMC" onclick="loadProducts(0);" >
                                            <label class="custom-control-label" >HMC</label></div>
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" name="b" class="custom-control-input category-coupon-checkbox"  value="HFA" onclick="loadProducts(0);" >
                                            <label class="custom-control-label" >HFA</label></div>
                                            <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" name="c" class="custom-control-input category-coupon-checkbox"  value="Other Certification" onclick="loadProducts(0);" >
                                            <label class="custom-control-label" >Other Certification</label></div>
                                </div>
                            </div> -->
                            <div class="filter_box">
                                <div class="stl_drp">
                                    <select class="form-control selectpicker" multiple title="Select a Halal Cert" name="halal_cert" onchange="loadProducts(0);">
                                        
                                        <option value="1">HMC Approved</option>
                                        <option value="2">HFA Approved</option>
                                        <option value="3">Other Certification</option>
                                        <option value="4">No Certification but fully halal</option>
                                        <option value="5">Non halal meat also served</option>
                                        <option value="6">Halal upon request only-predominantly non halal meat served</option>
                                        <option value="7">N/A</option>
                                    </select>
                                    <!--<select class="form-control selectpicker" name="halal_cert" onchange="loadProducts(0);">
                                    <ul>
                                    @forelse($halals as $key => $value)
                                    <li>
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" name="{{$key}}" class="custom-control-input category-coupon-checkbox" id="check_{{$value}}" value="{{$value}}" onclick="loadProducts(0);" >
                                            <label class="custom-control-label" for="check_{{$value}}">{{$key}}</label>
                                        </div>
                                    </li>
                                    
                                    @empty
                                    @endforelse
                                    </ul>
                                    </select>-->
                                </div>
                            </div>
                            <div class="filter_box">
                                <div class="stl_drp">
                                    <select class="form-control selectpicker" multiple title="Select an Alcohol Served" name="alchohol_served" onchange="loadProducts(0);">
                                        
                                        <option value="1" >Yes</option>
                                        <option value="2">No</option>
                                        <option value="3">Byob Allowed</option>
                                        <option value="4">N/A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="filter_box">
                                <div class="stl_drp">
                                    <select class="form-control selectpicker" multiple title="Select a Male Service" name="male_service" onchange="loadProducts(0);">
                                        
                                        <option value="1">Male Only</option>
                                        <option value="2">Upon Request</option>
                                        <option value="3">Mixed Group Service</option>
                                        <option value="4">No Guarantee</option>
                                        <option value="5">N/A</option>
                                    </select>
                                </div>
                            </div>

                            <div class="filter_box">
                                <div class="stl_drp">
                                    <select class="form-control selectpicker" multiple title="Select a Female Service" name="female_service" onchange="loadProducts(0);">
                                        
                                        <option value="1">Female Only</option>
                                        <option value="2">Upon Request</option>
                                        <option value="3">Mixed Group Service</option>
                                        <option value="4">No Guarantee</option>
                                        <option value="5">N/A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="filter_box">
                                <div class="stl_drp">
                                    <select class="form-control selectpicker" multiple title="Select a Gender Segregated" name="gender_segregated" onchange="loadProducts(0);">
                                        
                                        <option value="1">Yes</option>
                                        <option value="2">Upon Request</option>
                                        <option value="3">No</option>
                                        <option value="4">N/A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="filter_box">
                                <div class="stl_drp">
                                    <select class="form-control selectpicker" multiple title="Select a Family Area" name="family_area" onchange="loadProducts(0);">
                                        
                                        <option value="1">Yes</option>
                                        <option value="2">Upon Request</option>
                                        <option value="3">No</option>
                                        <option value="4">N/A</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="sortby">
                    </form>
                </div>
                <div class="col-sm-8 col-md-9">
                    <div class="right_part">
                        <div class="top_part d-flex justify-content-between align-items-center">
                            <h1>DEALS OFFERS</h1>
                            <div class="right_part_box">
                                <span class="sort_form">Sort By:</span>
                                <span class="stl_drp">
                                    <select class="form-control selectpicker"  onchange="sortByCoupon(this);">
                                        <option val="">Sort by Price</option>
                                        <option value="htl">Price High to Low</option>
                                        <option value="lth">Price Low to High</option> 
                                    </select>
                                </span>
                            </div>
                        </div>
                        <div class="bottom_part">
                            <div class="row" id="fetchCouponResults">
                            </div>
                        </div>
                        <div class="foot_prt text-center">
                            <a href="#" class="search_load_btn">SHOW MORE <i class="icofont-rounded-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop
@section('js')
<script src="{{ URL::asset('public/frontend/js/bootstrap-select.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/frontend/js/jquery.nicescroll.js') }}" type="text/javascript"></script>
<script>
                                        $(document).ready(function () {
<?php
if (sizeof($headcategories) > 0 && $headcategories[0]!=0):
    foreach ($headcategories as $hc):
        ?>
                                                    var cate = '{{$hc}}';
                                                    $('#check_' + cate).trigger('click');
    <?php endforeach;
else: ?>
                                                loadProducts();
<?php endif; ?>


                                        });
                                        $(".cust-scroll-table").niceScroll({touchbehavior: false, cursorcolor: "#2e4f7b", cursoropacitymax: 0.7, cursorwidth: 3, background: "#cccccc", cursorborder: "none", cursorborderradius: "5px", autohidemode: false});
                                        $(window).scroll(function () {
                                            $(".cust-scroll-table").getNiceScroll().resize();
                                        });
                                        $(window).resize(function () {
                                            $(".cust-scroll-table").getNiceScroll().resize();
                                        });
                                        var nicesx = $(".field-scroll").niceScroll(".field-scroll div", {touchbehavior: true, cursorcolor: "#2874f0", cursoropacitymax: 0.6, cursorwidth: 24, usetransition: true, hwacceleration: true, autohidemode: "hidden"});
                                        $(window).scroll(function () {
                                            $(".field-scroll").getNiceScroll().resize();
                                        });
                                        $(window).resize(function () {
                                            $(".field-scroll").getNiceScroll().resize();
                                        });
</script>
@endsection
