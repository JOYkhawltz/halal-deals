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
                                    <img class="img-fluid" src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="">
                                </div>
                                <div class="btm-box">
                                    <h1><a href="#">Halal-deals Shopping <img class="img-fluid" src="images/check_1.png" alt=""></a></h1>
                                    <ul class="feture-line">
                                        <li class="clearfix">
                                            <i class="fa fa-map-marker" aria-hidden="true"></i> <a href="#">{{($bus_desc->town)?$bus_desc->town.','. $bus_desc->city:''}}</a>
                                        </li>
                                        <li class="clearfix">
                                            <i class="fa fa-phone" aria-hidden="true"></i> <a href="#">{{($bus_desc->telphone_no)?'+'.$bus_desc->telphone_no:''}}</a>
                                        </li>
                                        <li class="clearfix">
                                            <i class="fa fa-globe" aria-hidden="true"></i>  <a href="#">{{$bus_desc->website?$bus_desc->website:''}}</a>
                                        </li>
                                        <li class="clearfix">
                                            <span class="left-prt"><i class="fa fa-money" aria-hidden="true"></i> Our Price</span>
                                            <span class="rgt-prt">${{number_format($advert_detail->hd_price,2)}}</span>
                                        </li>
                                        <li class="clearfix">
                                            <span class="left-prt"><i class="fa fa-money" aria-hidden="true"></i> Normal Price</span>
                                            <span class="rgt-prt">${{number_format($model->normal_price,2)}}</span>
                                        </li>
                                    </ul>
                                    <div class="btn-bx">
                                        <a href="#" class="btn">ADD TO CART</a>
                                    </div>

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
                                    Introduction
                                </a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse show" role="tabpanel" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="panel-body">
                                <h1 class="inner-heading">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</h1>
                                <p>{{$model->detailed_description}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="headingTwo">
                            <h4 class="panel-title">
                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Small Prints
                                </a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                            {{$model->smallprint}}
                            <div class="panel-body">
                                <h1 class="inner-heading mrg_btm">Additional Details</h1>
                                <ul class="row">
                                    @if(($bus_desc->halal_cert)==1)<li class="col-md-3"><i class="fa fa-check" aria-hidden="true"></i> Halal Certified</li> @endif  
                                    @if(($bus_desc->alchohol_served)==1)<li class="col-md-3"><i class="fa fa-check" aria-hidden="true"></i> Alchohol Served</li>@endif 
                                    @if(($bus_desc->male_service)==1)<li class="col-md-3"><i class="fa fa-check" aria-hidden="true"></i> Male Service</li>@endif 
                                    @if(($bus_desc->female_service)==1)<li class="col-md-3"><i class="fa fa-check" aria-hidden="true"></i> Female Service</li>@endif 
                                    @if(($bus_desc->gender_segregated)==1)<li class="col-md-3"><i class="fa fa-check" aria-hidden="true"></i> Gender Segregated</li>@endif 
                                    @if(($bus_desc->family_area)==1)<li class="col-md-3"><i class="fa fa-check" aria-hidden="true"></i> Family Area</li>@endif 
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="similar-deal-section">
                <h1 class="inner-heading">Similar Deals</h1>
                //similar deals
            </div>
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
            loop: true,
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
