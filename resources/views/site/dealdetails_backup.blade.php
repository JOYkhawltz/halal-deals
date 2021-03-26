@extends('layouts.main')
@section('css')
<link href="{{ URL::asset('public/frontend/css/bootstrap-select.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('public/frontend/css/owl.carousel.css') }}" rel="stylesheet">
<link href="{{ URL::asset('public/frontend/css/flexslider.css') }}" rel="stylesheet">
@stop
@section('content')
<section class="main-body-section">
    <section class="package_details_section">
        <div class="container">
            <div class="top-part">
                <div class="row">
                    <div class="col-md-9">
                        <div class="left-part">
                            <section class="single-product-slider">
                                <div id="product-gallery-slider" class="flexslider">
                                    <ul class="slides">
                                        <!--<img src="{{URL::asset('public/frontend/images/box.png')}}" />-->

                                        @if(count($model->images)>0)
                                        @foreach($model->images as $image)
                                        <li>
                                            <img src="{{($image->image_name!==NULL)?URL::asset('public/uploads/frontend/product/original/'.$image->image_name):URL::asset('public/frontend/images/box.png')}}" />
                                        </li>
                                        @endforeach
                                        @endif                                   
                                    </ul>
                                </div>
                                <div id="prd-gallery-carousel" class="flexslider">
                                    <ul class="slides">
                                        @if(count($model->images)>0)

                                        @foreach($model->images as $image)

                                        <li>
                                            <img src="{{($image->image_name!==NULL)?URL::asset('public/uploads/frontend/product/preview/'.$image->image_name):URL::asset('public/frontend/images/box.png')}}" />
                                        </li>
                                        @endforeach
                                        @endif                                         
                                    </ul>
                                </div>
                            </section>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="right-part">
                            <div class="package-dtl-bx">
                                <div class="img-box d-flex justify-content-center align-items-center">
                                    <img class="img-fluid" src="{{ URL::asset('public/frontend/images/logo_.png') }}" alt="">
                                </div>
                                <div class="btm-box">
                                    <h1><a href="javascript:void(0);">Halal-deals Shopping </a></h1>
                                    <ul class="feture-line">
                                        <li class="clearfix">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i> <a href="javascript:void(0);">{{($bus_desc->town)?$bus_desc->town.','. $bus_desc->city:''}}</a>
                                        </li>
                                        <li class="clearfix">
                                            <i class="fa fa-phone" aria-hidden="true"></i> <a href="javascript:void(0);">{{($bus_desc->telphone_no)?'+'.$bus_desc->telphone_no:''}}</a>
                                        </li>
                                        <li class="clearfix">
                                            <i class="fa fa-globe" aria-hidden="true"></i>  <a href="javascript:void(0);">{{$bus_desc->website?$bus_desc->website:''}}</a>
                                        </li>
                                        <li class="clearfix">
                                            <span class="left-prt"><i class="fa fa-money" aria-hidden="true"></i> Our Price</span>
                                            <span class="rgt-prt"><i class="fa fa-gbp" aria-hidden="true"></i>{{number_format($advert_detail->hd_price,2)}}</span>
                                        </li>
                                        <li class="clearfix">
                                            <span class="left-prt"><i class="fa fa-money" aria-hidden="true"></i> Normal Price</span>
                                            <span class="rgt-prt"><i class="fa fa-gbp" aria-hidden="true"></i>{{number_format($model->normal_price,2)}}</span>

                                        </li>
                                        <input type='hidden'value='1'name='quantity' id='quantity' >
                                    </ul>
                                    @csrf
                                    @if (Auth()->guard('frontend')->guest())
                                    <div class="btn-bx">
                                        <a href="javascript:void(0);" class="btn" onclick="AddtoCart(this);" data-advert_type="deal" data-advert_id="{{$advert_detail->advert_ID}}">ADD TO CART</a>
                                    </div>
                                    @elseif((Auth()->guard('frontend')->user()->type_id)==4)
                                    <div class="btn-bx">
                                        
                                        <a href="javascript:void(0);" class="btn" onclick="AddtoCart(this);" data-advert_type="deal" data-advert_id="{{$advert_detail->advert_ID}}">ADD TO CART</a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordian_area">
                <h1 class="inner-heading">Details</h1>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne" class="collapsed">
                                    Description
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="panel-body">
                                <h1 class="inner-heading">{{$model->brief_description}}</h1>
                                <p>{{$bus_desc->introduction}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo" class="collapsed">
                                    Details
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="panel-body">
                                <h1 class="inner-heading">{{$model->detailed_description}}</h1>
                                <p>{{$bus_desc->details}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingThree">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Small Prints
                                </a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
                            Advert :{{$advert_detail->smallprint}}<br>
                            Specific times details : {{$advert_detail->spec_times_details}}<br>
                            New customer only : {{($advert_detail->new_cust_only=="1")?"yes":"no"}}<br>
                            Product : {{$model->smallprint}}<br>
                            Business : {{$bus_desc->smallprint}}
                        </div>
                    </div>
                     <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingFour">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour" class="collapsed">
                                    Embeded Youtube Video
                                </a>
                            </h4>
                        </div>
                        <div id="collapseFour" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
                            <div class="panel-body">
                                @if(!empty($advert_detail->youtube_url))
                                <iframe width="420" height="315" src="{{$advert_detail->youtube_url}}">
                                </iframe>
                                @else
                                    No url found
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <h1 class="inner-heading mrg_btm">Additional Details</h1>
                        <ul class="row">

                            <!--  Halal Certified    -->
                            @if($bus_desc->halal_cert==1)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="HMC Approved"><i class="fa fa-check" aria-hidden="true"></i> Halal Certified</li>  
                            @elseif($bus_desc->halal_cert==2)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="HFA Approved"><i class="fa fa-check" aria-hidden="true"></i> Halal Certified</li> 
                            @elseif($bus_desc->halal_cert==3)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="Other Certification"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Halal Certified</li>
                            @elseif($bus_desc->halal_cert==4)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="No Certification but fully halal"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Halal Certified</li>
                            @elseif($bus_desc->halal_cert==5)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="Non halal meat also served"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Halal Certified</li>
                            @elseif($bus_desc->halal_cert==6)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="Halal upon request only-predominantly non halal meat served"><i class="fa fa-times" aria-hidden="true" style="color:#f00;"></i> Halal Certified</li>
                            @else
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="N/A"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Halal Certified </li> 
                            @endif
                            <!--  Alchohol Served    -->
                            @if($bus_desc->alchohol_served==1)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="Yes"><i class="fa fa-check" aria-hidden="true"></i> Alchohol Served </li>  
                            @elseif($bus_desc->alchohol_served==2)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="No"><i class="fa fa-times" aria-hidden="true" style="color:#f00;"></i> Alchohol Served </li> 
                            @elseif($bus_desc->alchohol_served==3)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="Byob Allowed"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Alchohol Served </li>
                            @elseif($bus_desc->alchohol_served==4)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="N/A"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Alchohol Served </li>    
                            @else
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="N/A"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Alchohol Served </li> 
                            @endif
                            <!--  Male Service   -->
                            @if($bus_desc->male_service==1)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="Male Only"><i class="fa fa-check" aria-hidden="true"></i> Male Service</li>  
                            @elseif($bus_desc->male_service==2)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="Upon Request"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Male Service </li> 
                            @elseif($bus_desc->male_service==3)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="Mixed Group Service"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Male Service</li>
                            @elseif($bus_desc->male_service==4)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="No Guarantee"><i class="fa fa-times" aria-hidden="true" style="color:#f00;"></i> Male Service</li>     
                            @elseif($bus_desc->male_service==5)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="N/A<"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Male Service </li> 
                            @else
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="N/A"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Male Service </li> 
                            @endif
                            <!--  Female Service   -->
                            @if($bus_desc->female_service==1)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="Female Only"><i class="fa fa-check" aria-hidden="true"></i> Female Service </li>  
                            @elseif($bus_desc->female_service==2)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="Upon Request"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Female Service </li> 
                            @elseif($bus_desc->female_service==3)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="Mixed Group Service"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Female Service </li>
                            @elseif($bus_desc->female_service==4)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="No Guarantee"><i class="fa fa-times" aria-hidden="true" style="color:#f00;"></i> Female Service </li>     
                            @elseif($bus_desc->female_service==5)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="N/A<"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Female Service </li> 
                            @else
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="N/A"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Female Service </li> 
                            @endif
                            <!--  Gender Segregated   -->
                            @if($bus_desc->gender_segregated==1)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="Yes"><i class="fa fa-check" aria-hidden="true"></i> Gender Segregated </li>  
                            @elseif($bus_desc->gender_segregated==2)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="Upon Request"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Gender Segregated </li> 
                            @elseif($bus_desc->gender_segregated==3)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="No"><i class="fa fa-times" aria-hidden="true" style="color:#f00;"></i> Gender Segregated </li>
                            @elseif($bus_desc->gender_segregated==4)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="N/A"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Gender Segregated </li>                                  
                            @else
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="N/A"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Gender Segregated </li> 
                            @endif
                            <!--  Family Area   -->
                            @if($bus_desc->family_area==1)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="Yes"><i class="fa fa-check" aria-hidden="true"></i> Family Area </li>  
                            @elseif($bus_desc->family_area==2)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="Upon Request"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Family Area </li> 
                            @elseif($bus_desc->family_area==3)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="No"><i class="fa fa-times" aria-hidden="true" style="color:#f00;"></i> Family Area </li>
                            @elseif($bus_desc->family_area==4)
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="N/A"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Family Area </li>                                  
                            @else
                            <li class="col-md-3" data-toggle="tooltip" data-placement="bottom" title="N/A"><i class="fa fa-minus" aria-hidden="true" style="color:#2196F3;"></i> Family Area </li> 
                            @endif

                        </ul>
                    </div>


                </div>
            </div>
            @if(count($adverts)>0)
            <div class="similar-deal-section">
                <h1 class="inner-heading">Similar Deals</h1>
                <div class="row">
                    <div class="col-md-12">
                        <div class="owl-carousel active_testimonial owl-theme list-wrap">

                            <?php foreach ($adverts AS $advert) { ?>
                                <div class="item">
                                    <div class="offer-box">
                                        <div class="media">
                                            <div class="media-body">
                                                <div class="off-price">{{str_limit($advert->title,15)}}</div>
                                            
                                            <div class="media-right">
                                                @if(count($advert->product)>0)
                                                @if(!empty($advert->product->defaultPic))
                                                <div class="product-pic"><img src="{{ URL::asset('public/uploads/frontend/product/preview/'.$advert->product->defaultPic->image_name) }}" ></div>
                                                @else
                                                <div class="product-pic"><img src="{{ URL::asset('public/frontend/images/product1.png') }}"></div>
                                                @endif
                                                @endif
                                            </div>
                                                </div>
                                        </div>
                                        <div class="offer-txt">
                                            {{ str_limit($advert->smallprint, 80)}}
                                        </div>
                                        <div class="media">
                                            <div class="media-right">
                                                <a href="{{Route('advert-details',['id'=>$advert->advert_ID])}}" class="deflt-btn">Get Coupon</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

    </section>
</section>
@stop
@section('js')
<script src="{{ URL::asset('public/frontend/js/bootstrap-select.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/frontend/js/jquery.nicescroll.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/frontend/js/owl.carousel.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/frontend/js/jquery.flexslider.js') }}" type="text/javascript"></script>

<script>
                                            $(window).scroll(function () {
                                                var scroll = $(window).scrollTop();
                                                if (scroll >= 100)
                                                    $(".header-section").addClass("affix");
                                                else
                                                    $(".header-section").removeClass("affix");
                                            });
</script>
<script>
    $(document).ready(function () {
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
    });
</script>

<script>
    jQuery(document).ready(function ($) {
        $('.owl-carousel').owlCarousel({
            margin: 30,
            items: 2,
            loop: false,
            Type: Number,
            Default: 1,
            autoplay: false,
            nav: true,
            navText: false,
            responsive: {
                0: {
                    items: 2,
                    margin: 10,
                    nav: true,
//                            navText: ($('.active_testimonial').length) ? ["<i class='fa fa-long-arrow-left'>", "<i class='fa fa-long-arrow-right'>"] : false,
                },
                600: {
                    items: 3,
                    nav: true,
                    navText: ($('.active_testimonial').length) ? ["<i class='fa fa-arrow-circle-left'>", "<i class='fa fa-arrow-circle-right'>"] : false,
                },
                1000: {
                    items: 4,
                    nav: true,
                    navText: ($('.active_testimonial').length) ? ["<i class='fa fa-arrow-circle-left'>", "<i class='fa fa-arrow-circle-right'>"] : false,
                }
            }
        });
    });


    $('#prd-gallery-carousel').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        itemWidth: 118,
        itemMargin: 25,
        asNavFor: '#product-gallery-slider'
    });

    $('#product-gallery-slider').flexslider({
        animation: "slide",
        controlNav: false,
        animationLoop: false,
        slideshow: false,
        sync: "#prd-gallery-carousel",
        start: function (slider) {
            $('body').removeClass('loading');
        }
    });

</script> 
@stop
