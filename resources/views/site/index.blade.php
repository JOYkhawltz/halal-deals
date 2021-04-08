@extends('layouts.main')
@section('css')
<link href="{{ URL::asset('public/frontend/css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" />
@stop
@section('content')
<section class="main-body-section">
    <div class="">
       <div class="top-banner" >
            <div class="owl-carousel banner-slider">
                <div class="item">
                    <img src="{{($pages[1]->type==='2' && $pages[1]->content_body!='')?URL::asset('public/uploads/frontend/cms/pictures/'.$pages[1]->content_body):URL::asset('public/frontend/images/banner-bg.jpg')}}" />
                </div>
                <div class="item">
                    <img src="{{($pages[2]->type==='2' && $pages[2]->content_body!='')?URL::asset('public/uploads/frontend/cms/pictures/'.$pages[2]->content_body):URL::asset('public/frontend/images/banner-bg2.jpg')}}" />
                </div>
            </div>
            @if($search_and_text_area->value == 1)
            <div class="banner-search-caption">
                <div class="row">
                    <div class="col-sm-8 mx-auto banner-caption col-12">
                        <h2>{!!($pages[0]->type==='1' && $pages[0]->content_body!==NULL)?$pages[0]->content_body:'Find foods' !!}</h2>
                        <form action="{{Route('search-coupon')}}" method="get">
                            <div class="search-wrap">
                                <input type="text" name="title" placeholder="Search for mobile offers, watches, food...">
                                <button type="Submit"><i class="icofont-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="justify-content-center" style="height:500px; display:flex; z-index: 9; background-color: #f7f7f7; display:none;">
            <div class="container" style="display:flex;">
                <div class="col-sm-6 justify-content-center">
                    <div  style="padding: 80px 0px 80px 50px; max-width:500px; text-align:start;">
                        <h1 style="font-size: 30px;font-weight: 400;color:green;">Drink Fresh Live Fresh</h1>
                        <h1 style="font-size: 54px;font-weight: 800;color:green;">FRUIT JUICE</h1>
                        <h1 style="font-size: 35px;font-weight: 600;color:black;">GOOD FOR HEALTH</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                        </p>
                        <div style="display: inline; border-radius: 5px; background-color: green; padding: 7px 15px;"><a style="color:white;"href= "{{ Route('about-us') }}" >Read More <i class="icofont-rounded-right"></i></a></div>
            
                    </div>
                </div>
            
            
                <div class="col-sm-6">
                    <img style="width:400px; height:450px;"src="{{($pages[2]->type==='2' && $pages[2]->content_body!='')?URL::asset('public/uploads/frontend/cms/pictures/'.$pages[2]->content_body):URL::asset('public/frontend/images/roastchicken.jpg')}}" />
                    <img style="position: absolute; top: 20%; left:50% "src="{{($pages[2]->type==='2' && $pages[2]->content_body!='')?URL::asset('public/uploads/frontend/cms/pictures/'.$pages[2]->content_body):URL::asset('public/frontend/images/halal-tag.png')}}" />

                </div>
            </div>
        </div>
        <style>
            .category{padding:30px; background-color:green; text-align: start;}
            .category h3{color: white; font-size: 16px; font-weight: bold;}
            .category p{color: white; font-size: 12px;}
            .category .btn{ font-size: 12px; display: inline; border-radius: 5px; background-color: white; padding: 7px 15px;}
            .category .btn:hover{ background-color: black; }
            .category .btn a{ color: black; }
            .category .btn:hover a{color: white;}
        </style>
        <div class="container" style="margin-top:-50px; display:none;">
        <div class="top-banner row justify-content-center" style="height: 170px; display:flex; z-index: 9; ">
            <div class="col-sm-2 category" style="background-color:green;">
                <h3>Wellbeing</h3>
                <p style="">To view this category click below</p>
                <div class="btn"><a href= "{{ Route('about-us') }}" >Read More </a></div>
            </div>
            <div class="col-sm-2 category" style="background-color:darkgreen; ">
                <h3>Hotels</h3>
                <p style="">To view this category click below</p>
                <div class="btn"><a href= "{{ Route('about-us') }}" >Read More </a></div></div>
            <div class="col-sm-2 category" style="background-color:green; ">
            <h3>Products</h3>
                <p style="">To view this category click below</p>
                <div class="btn"><a href= "{{ Route('about-us') }}" >Read More </a></div></div>
            <div class="col-sm-2 category" style="background-color:darkgreen; ">
            <h3>Restaurants</h3>
                <p style="">To view this category click below</p>
                <div class="btn"><a href= "{{ Route('about-us') }}" >Read More </a></div></div>
            <div class="col-sm-2 category" style="background-color:green; ">
            <h3>Other Services</h3>
                <p style="">To view this category    click below</p>
                <div class="btn"><a href= "{{ Route('about-us') }}" >Read More </a></div></div>
        </div>
        </div>   
        @if(count($today_deals)>0)
        <div class="body-box">
            <h2>POPULAR OFFERS OF THE DAY</h2>
            <div class="body-box-inner">
                <div class="owl-carousel offer-slider">
                    @foreach($today_deals as $deal)
                    <div class="item">
                       @if($deal->other_options_available=='1'&&$deal->new_cust_only=='1')
                        @if (Auth()->guard('frontend')->guest())
                        <a href="javascript:;" onclick="showSigninModal();">
                        @else
                        <a href="{{Route('advert-details',['id'=>$deal->advert_ID])}}">
                        @endif
                        @else
                        <a href="{{Route('advert-details',['id'=>$deal->advert_ID])}}">
                        @endif
                            <div class="offer-box">
                                <div class="offer-box-top">
                                    @if(count($deal->product)>0)
                                    @if(isset($deal->product->defaultPic))
                                    <img class="img-fluid" src="{{ URL::asset('public/uploads/frontend/product/preview/'.$deal->product->defaultPic->image_name) }}"/>
                                    @else
                                    <img class="img-fluid" src="{{ URL::asset('public/frontend/images/product1.png') }}"/>
                                    @endif
                                    @endif
                                </div>
                                <div class="offer-box-bottom">
                                    <div>
                                    <h3>{{str_limit($deal->title,15)}}</h3>
                                    <h5>{{$deal->business->name}}</h5>
                                    </div>
                                    <div>
                                        <span class="ourprice">Our price<h4><i class="icofont-pound"></i>{{$deal->cost_price}}</h4></span>
                                        <span class="normalprice">Normal price<h4><i class="icofont-pound"></i>{{$deal->hd_price}}</h4></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        @if(count($deals)>0)
        <div class="body-box" style="background-color: #17c40a33; margin-top: 0px;";>
            <h2 style="border-bottom: #5e5e5e solid 1px;">HOT OFFERS</h2>
            <div class="body-box-inner">
                <div class="owl-carousel offer-slider">
                    @foreach($hot_deals as $deal)
                    <div class="item">
                       @if($deal->other_options_available=='1'&&$deal->new_cust_only=='1')
                        @if (Auth()->guard('frontend')->guest())
                        <a href="javascript:;" onclick="showSigninModal();">
                        @else
                        <a href="{{Route('advert-details',['id'=>$deal->advert_ID])}}">
                        @endif
                        @else
                        <a href="{{Route('advert-details',['id'=>$deal->advert_ID])}}">
                        @endif
                            <div class="offer-box">
                                <div class="offer-box-top">
                                    @if(count($deal->product)>0)
                                    @if(isset($deal->product->defaultPic))
                                    <img class="img-fluid" src="{{ URL::asset('public/uploads/frontend/product/preview/'.$deal->product->defaultPic->image_name) }}"/>
                                    @else
                                    <img class="img-fluid" src="{{ URL::asset('public/frontend/images/product1.png') }}"/>
                                    @endif
                                    @endif
                                </div>
                                <div class="offer-box-bottom">
                                    <div>
                                    <h3>{{str_limit($deal->title,15)}}</h3>
                                    <h5>{{$deal->business->name}}</h5>
                                    </div>
                                    <div>
                                        <span class="ourprice">Our price<h4><i class="icofont-pound"></i>{{$deal->cost_price}}</h4></span>
                                        <span class="normalprice">Normal price<h4><i class="icofont-pound"></i>{{$deal->hd_price}}</h4></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        @if(count($deals)>0)
        <div class="body-box" style="display:none;">
            <h2>Hot Offers</h2>
            <div class="body-box-inner">
                <div class="row">
                    @foreach($hot_deals as $deal)
                    <div class="col-sm-3">
                        @if($deal->other_options_available=='1'&&$deal->new_cust_only=='1')
                        @if (Auth()->guard('frontend')->guest())
                        <a href="javascript:;" onclick="showSigninModal();">
                        @else
                        <a href="{{Route('advert-details',['id'=>$deal->advert_ID])}}">
                        @endif
                        @else
                        <a href="{{Route('advert-details',['id'=>$deal->advert_ID])}}">
                        @endif
                            <div class="offer-box">
                                <div class="offer-box-top">
                                    @if(count($deal->product)>0)
                                    @if(isset($deal->product->defaultPic))
                                    <img class="img-fluid" src="{{ URL::asset('public/uploads/frontend/product/preview/'.$deal->product->defaultPic->image_name) }}"/>
                                    <!--<img style="position: absolute; right:32px; width:30px; height:30px; "src="{{URL::asset('public/frontend/images/halal-tag.png')}}" />-->
                                    @else
                                    <img class="img-fluid" src="{{ URL::asset('public/frontend/images/product1.png') }}"/>
                                    @endif
                                    @endif
                                </div>
                                <div class="offer-box-bottom">
                                    <div>
                                    <h3>{{str_limit($deal->title,15)}}</h3>
                                    <h5>{{$deal->business->name}}</h5>
                                    </div>
                                    <div>
                                        <span class="ourprice">Our price<h4><i class="icofont-pound"></i>{{$deal->cost_price}}</h4></span>
                                        <span class="normalprice">Normal price<h4><i class="icofont-pound"></i>{{$deal->hd_price}}</h4></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="view-more text-center"><a href="{{Route('hot-offers')}}">Show More <i class="icofont-rounded-right"></i></a></div>
            </div>
        </div>


      <!--<div class="" style="margin-top:100px; ">
            <div class="top-banner" style="height: 400px; display:flex; z-index: 9;">
                <div class="col-sm-4" style="background-color: darkgreen; padding:0px;">
                <img style="position: center center; width:100%; height:100%;"src="{{($pages[2]->type==='2' && $pages[2]->content_body!='')?URL::asset('public/uploads/frontend/cms/pictures/'.$pages[2]->content_body):URL::asset('public/frontend/images/admin-msg.png')}}">
                </div>
                <div class="col-sm-8" style="background-color: #213820; ">
                    <div  style="padding: 80px 0px 80px 50px;  text-align:start;">
                            <h1 style="font-size: 18px;font-weight: 200;color:white;">A short message from us</h1>
                            <h1 style="font-size: 30px;font-weight: 600;color:white;">Welcome to</h1>
                            <img style="width:300px; height:70px;"src="{{($pages[2]->type==='2' && $pages[2]->content_body!='')?URL::asset('public/uploads/frontend/cms/pictures/'.$pages[2]->content_body):URL::asset('public/frontend/images/mail_logo.png')}}" />
                            <p style="color:white;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                    </div>
                </div>
            </div>
        </div> -->   

        <div class="body-box">
            <h2>Halal Deals</h2>
            <div class="body-box-inner">
                <div class="row">
                    @foreach($deals as $deal)
                    <div class="col-sm-3">
                        @if($deal->other_options_available=='1'&&$deal->new_cust_only=='1')
                        @if (Auth()->guard('frontend')->guest())
                        <a href="javascript:;" onclick="showSigninModal();">
                        @else
                        <a href="{{Route('advert-details',['id'=>$deal->advert_ID])}}">
                        @endif
                        @else
                        <a href="{{Route('advert-details',['id'=>$deal->advert_ID])}}">
                        @endif
                            <div class="offer-box">
                                <div class="offer-box-top">
                                    @if(count($deal->product)>0)
                                    @if(isset($deal->product->defaultPic))
                                    <img class="img-fluid" src="{{ URL::asset('public/uploads/frontend/product/preview/'.$deal->product->defaultPic->image_name) }}"/>
                                    @else
                                    <img class="img-fluid" src="{{ URL::asset('public/frontend/images/product1.png') }}"/>
                                    @endif
                                    @endif
                                </div>
                                <div class="offer-box-bottom">
                                    <div>
                                    <h3 style="width:1px ! important">{{str_limit($deal->title,15)}}</h3>
                                    <h5>{{$deal->business->name}}</h5>
                                    </div>
                                    <div>
                                        <span class="ourprice">Our price<h4><i class="icofont-pound"></i>{{$deal->cost_price}}</h4></span>
                                        <span class="normalprice">Normal price<h4><i class="icofont-pound"></i>{{$deal->hd_price}}</h4></span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="view-more text-center"><a href="{{Route('search-coupon')}}">Show More <i class="icofont-rounded-right"></i></a></div>
            </div>
        </div>
        @endif
        <!--        <div class="body-box">
                    <h2>Get The Latest & Best Coupon/Offer Ale rts</h2>
                    <div class="body-box-inner">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="subscribe-txt">
                                    35,00,000+ Subscriptions Across India! & Counting! Subscribe to have new coupon lists delivered directly to your inbox. We value your savings as much as you do. 
                                    Subscribe now and keep saving on everything with the latest coupons and offers!
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="subscribe-form">
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="Enter your email">
                                        <span class="input-group-btn">
                                            <button class="deflt-btn" type="submit">Subscribe</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
    </div>
</section>
<script>
    jQuery(document).ready(function ($) {
        var owl2 = $('.banner-slider');
        owl2.owlCarousel({
//            items: 4,
            loop: true,
            responsiveClass: true,
            nav: true,
            pagination: false,
            nav: true,
            autoplay: true,
            autoplaySpeed: 2000,
            navText: [
                "<i class='icofont-line-block-left'></i>",
                "<i class='icofont-line-block-right'></i>"
            ],
            beforeInit: function (elem) {
                //Parameter elem pointing to $("#owl-demo")
                random(elem);
            },
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 1
                }
            }
        });
    });</script>
<script>
    jQuery(document).ready(function ($) {
        var owl2 = $('.offer-slider');
        owl2.owlCarousel({
//            items: 4,
            loop: false,
            responsiveClass: true,
            nav: true,
            pagination: false,
            nav: true,
            autoplay: true,
            autoplaySpeed: 2000,
            navText: [
                "<i class='icofont-line-block-left'></i>",
                "<i class='icofont-line-block-right'></i>"
            ],
            beforeInit: function (elem) {
                //Parameter elem pointing to $("#owl-demo")
                random(elem);
            },
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 3
                }
            }
        });
    });</script>
@stop
@section('js')
<script src="{{ URL::asset('public/frontend/js/owl.carousel.min.js') }}" type="text/javascript"></script>
@stop