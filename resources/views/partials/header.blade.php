<?php

use App\ProductType;

$limit = 12;
$offset = 0;
$title = (isset($_GET['title'])) ? $_GET['title'] : NULL;
$categories = ProductType::select('id', 'name')->where('status', '1')->get();
?>
<section class="header-section">
    <div class="top-bar">
        <div class="">
            <div class="row">
                <!--+*
                <div class="col-sm-4">
                    <div class="top-search">
                        <form action="{{Route('search-coupon')}}" method="get">
                            <div class="search-wrap">
                                <input type="text" name="title" placeholder="Search for mobile offers, watches, food...">
                                <button type="Submit"><i class="icofont-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div> -->
                <div class="col-sm-6 col-md-3 col-lg-3 " style="width:50%">
                    <div style="padding-top:10px;  height:50px; padding-left: 20px; " class="logo-section"><a href="{{ Route('/') }}"><img style = "height:100%;" src="{{ URL::asset('public/frontend/images/mail_logo.png') }}" alt="" /></a></div>
                </div>






                <div class="col-sm-1 col-md-4 order-md-12 col-lg-4 " style="width:50%" >
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <i class="icofont-navigation-menu"></i>                       
                        </button>
                    </div>
                    <div style="padding: 8px;" class="nav-bar collapse navbar-collapse" id="myNavbar">
                        <ul>
                            @php
                            use Illuminate\Support\Facades\Cookie;
                            if (Auth()->guard('frontend')->guest() && Cookie::has('guest_user_halaldeals')) {
                            $user_id = Cookie::get('guest_user_halaldeals');
                            } else if(!Auth()->guard('frontend')->guest()) {
                            $user_id = Auth()->guard('frontend')->user()->id;
                            }else{
                            $user_id=0;
                            }
                            if($user_id!==0){
                            $cart_count=App\Cart::where('user_id','=',$user_id)->wherestatus('1')->count();
                            }else{
                            $cart_count=0;
                            }
                            $wallet=App\Business::where('user_id','=',$user_id)->first();
                            @endphp
                            @if (Auth()->guard('frontend')->guest() || (isset(Auth()->guard('frontend')->user()->type_id) && Auth()->guard('frontend')->user()->type_id ==="4"))
                            <li class="cart-menu"><a href="{{ Route('cart') }}" title="cart"><i style="font-size:22px; color: darkgreen;" class="icofont-shopping-cart"></i><span id="cart_count">{{$cart_count}}</span></a></li>
                            @endif

                            @if (Auth()->guard('frontend')->guest())
                            <li><a class="hvr-signin" style=" " href="javascript:;" onclick="showSigninModal();">Login</a></li>
                            <li><a class="hvr-signup" style=" " href="javascript:;" onclick="showSignupModal();">Signup</a></li>
                            
                            @else
                            @if (Auth()->guard('frontend')->user()->type_id ==="3")
                            <li class="cart-menu nw"><a style="font-size:18px; color: black;" href="{{Route('withdrawal-wallet')}}" title="Wallet"><i style="font-size:22px; color: darkgreen;" class="icofont-wallet"></i><i style="font-size:22px; color: darkgreen;" class="fa fa-gbp" aria-hidden="true"></i>{{number_format($wallet->wallet_amount,2)}}</a></li>
                            @endif
                            <li class="profile-menu">
                                <img src="{{(Auth()->guard('frontend')->user()->image!='')? URL::asset('public/uploads/frontend/profile_picture/preview').'/'.Auth()->guard('frontend')->user()->image:URL::asset('public/frontend/images/default-pic.jpeg') }}" alt="" />
                            </li>
                            <li class="profile-drop-menu">
                                <div class="dropdown show">
                                    <a style="color: black;" class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Auth()->guard('frontend')->user()->full_name }}</a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="{{ Route('dashboard') }}">Dashboard</a>
                                        <a class="dropdown-item" href="{{ Route('my-profile') }}">My Profile</a>
                                        <a class="dropdown-item" href="{{ Route('logout') }}">Logout</a>
                                    </div>
                                </div>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>




 



                
                
                <div class="col-sm-8 col-md-5 col-md-push-4 col-lg-5 col-lg-push-4">
                <div class="filter" style="padding-right: 10px; display: inline-block; float:left">               
                    <div class="top-drop-btn">
                        <div class="dropdown show">
                            <a  class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter</a>
                            <div class="dropdown-menu cst_menu_new" aria-labelledby="dropdownMenuLink">
                                <form action="{{Route('search-coupon')}}"  method="get">
                                    <div>
                                        <div class="filter_box">
                                            <h2 class="mb-2">Categories</h2>
                                            <ul class="cust-scroll-table">
                                                @forelse($categories as $category)
                                                <li>
                                                    <div class="custom-control custom-checkbox mr-sm-2">
                                                        <input type="checkbox" name="category[]" class="custom-control-input category-coupon-checkbox-find" id="check_left_{{$category->id}}" value="{{$category->id}}">
                                                        <label class="custom-control-label" for="check_left_{{$category->id}}">{{$category->name}}</label>
                                                    </div>
                                                </li>
                                                @empty
                                                @endforelse
                                            </ul>
                                        </div>
                                        
                                        <div class="filter_box d-none">
                                            <h2>Sub Categories</h2>
                                            <ul class="cust-scroll-table"  id="fetch-subcategory">

                                            </ul>
                                        </div>

                                        <div class="filter_box">
                                             <h2>Location</h2><br/>
                                            <input type="text" class="form-control " name="town" placeholder="Enter town" value="{{old('town')}}"><br/>
                                            <input type="text" class="form-control " name="city" placeholder="Enter city" value="{{old('city')}}"><br/>
                                            <input type="text" class="form-control " name="post_code" placeholder="Enter postcode" value="{{old('post_code')}}" >
                                        </div>
                                        <div class="filter_box">
                                            <h2>Price</h2><br/>
                                            <input type="text" class="form-control " name="min_price" placeholder="Minimum price" value="{{old('max_price')}}" ><br/>
                                            <input type="text" class="form-control " name="max_price" placeholder="Maximum price" value="{{old('max_price')}}" >
                                        </div>
                                        <div class="text-center p-2">
                                            <button type="Submit" class="deflt-btn" style="border:none;cursor: pointer;">Find</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                    <div class="top-search" style="display:inline-block;  margin: 0px; !important">
                        <form action="{{Route('search-coupon')}}" method="get">
                            <div class="search-wrap">
                                <input type="text" name="title" placeholder="Search for mobile offers, watches, food...">
                                <button type="Submit"><i class="icofont-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>

                
                
                <!--                <div class="col -sm-2 col-6">
                                    <div class="top-drop-btn float-left">
                                        <div class="dropdown show">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort</a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">                                
                                                                                <a class="dropdown-item" href="#">Action</a>
                                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                <span class="sort_form">Sort By:</span>
                                                <div class="filter_box">
                                                    <input type="text" class="form-control filterbykeyword" name="location" placeholder="Location" required="">
                                                </div>
                                                <div class="filter_box">
                
                                                    <span class="stl_drp">
                                                        <select class="form-control selectpicker" >
                                                            <option val="">Sort by Price</option>
                                                            <option value="htl">Price High to Low</option>
                                                            <option value="lth">Price Low to High</option> 
                                                        </select>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

               <!-- <div class="col-sm-2 col-6">               
                    <div class="top-drop-btn float-left">
                        <div class="dropdown show">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter</a>
                            <div class="dropdown-menu cst_menu_new" aria-labelledby="dropdownMenuLink">
                                <form action="{{Route('search-coupon')}}"  method="get">
                                    <div>
                                        <div class="filter_box">
                                            <h2 class="mb-2">Categories</h2>
                                            <ul class="cust-scroll-table">
                                                @forelse($categories as $category)
                                                <li>
                                                    <div class="custom-control custom-checkbox mr-sm-2">
                                                        <input type="checkbox" name="category[]" class="custom-control-input category-coupon-checkbox-find" id="check_left_{{$category->id}}" value="{{$category->id}}">
                                                        <label class="custom-control-label" for="check_left_{{$category->id}}">{{$category->name}}</label>
                                                    </div>
                                                </li>
                                                @empty
                                                @endforelse
                                            </ul>
                                        </div>
                                        
                                        <div class="filter_box d-none">
                                            <h2>Sub Categories</h2>
                                            <ul class="cust-scroll-table"  id="fetch-subcategory">

                                            </ul>
                                        </div>

                                        <div class="filter_box">
                                             <h2>Location</h2><br/>
                                            <input type="text" class="form-control " name="town" placeholder="Enter town" value="{{old('town')}}"><br/>
                                            <input type="text" class="form-control " name="city" placeholder="Enter city" value="{{old('city')}}"><br/>
                                            <input type="text" class="form-control " name="post_code" placeholder="Enter postcode" value="{{old('post_code')}}" >
                                        </div>
                                        <div class="filter_box">
                                            <h2>Price</h2><br/>
                                            <input type="text" class="form-control " name="min_price" placeholder="Minimum price" value="{{old('max_price')}}" ><br/>
                                            <input type="text" class="form-control " name="max_price" placeholder="Maximum price" value="{{old('max_price')}}" >
                                        </div>
                                        <div class="text-center p-2">
                                            <button type="Submit" class="deflt-btn" style="border:none;cursor: pointer;">Find</button>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>-->

                
            </div>
        </div>
    </div>
    

    <div class="top-bar" style=" background-color: #e8edf3; padding: 0px; padding-left: 0px;" >
        <div class="">
            <div class="row">
                <div class= " col-md-9 col-lg-8 " >
                    <a class="navi" href="{{ URL::asset('search-coupon?category%5B%5D=1')}}">Wellbeing</a>
                    <a class="navi" href="{{ URL::asset('search-coupon?category%5B%5D=2')}}">Hotels</a>
                    <a class="navi" href="{{ URL::asset('search-coupon?category%5B%5D=3')}}">Products</a>
                    <a class="navi" href="{{ URL::asset('search-coupon?category%5B%5D=4')}}">Restaurants</a>
                    <a class="navi" href="{{ URL::asset('search-coupon?category%5B%5D=5')}}">Other Services</a>
                </div>
            
               
    
                <!--                <div class="col-sm-2 col-6">
                                    <div class="top-drop-btn float-left">
                                        <div class="dropdown show">
                                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort</a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">                                
                                                                                <a class="dropdown-item" href="#">Action</a>
                                                                                <a class="dropdown-item" href="#">Another action</a>
                                                                                <a class="dropdown-item" href="#">Something else here</a>
                                                <span class="sort_form">Sort By:</span>
                                                <div class="filter_box">
                                                    <input type="text" class="form-control filterbykeyword" name="location" placeholder="Location" required="">
                                                </div>
                                                <div class="filter_box">
                
                                                    <span class="stl_drp">
                                                        <select class="form-control selectpicker" >
                                                            <option val="">Sort by Price</option>
                                                            <option value="htl">Price High to Low</option>
                                                            <option value="lth">Price Low to High</option> 
                                                        </select>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->

                <div class= "col-sm-0 col-md-0 col-lg-4" style="text-align: center; padding-right: 20px; border-radius: 7px 0px 0px 7px; background-color: darkgreen;" >
                    <a class="navi-covid" href="{{ URL::asset('')}}">Halaldeals response to COVID-19</a>

                    <!--<p style= "font-size: 18px;  margin-top: 18px;"><i style="font-size:22px; color: darkgreen;"class="icofont-phone"></i>(+1) 234 456 7891</p>-->
                </div>

               <!-- <div class="col-sm-0">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                            <i class="icofont-navigation-menu"></i>                       
                        </button>
                    </div>
                    
                </div>-->
            </div>
        </div>
    </div>
    <!--    <div class="top-header">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="logo-section"><a href="#"><img src="{{ URL::asset('public/frontend/images/logo.png') }}" alt="" /></a></div>
                    </div>
                    <div class="col-sm-7">
                        <div class="top-search">
                            <div class="search-wrap">
                                <input type="text" placeholder="Search for mobile offers, watches, food...">
                                <button type="Submit"><i class="icofont-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="top-drop-btn float-left">
                            <div class="dropdown show">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
    
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <div class="top-cart-btn float-right">
                            <a href="#" class="deflt-btn"><i class="icofont-shopping-cart"></i> My Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
</section>
