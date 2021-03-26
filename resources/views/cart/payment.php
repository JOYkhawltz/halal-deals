@extends('layouts.main')

@section('content')   
<div class="how_it_works padding-50">
    <section class="checkout_main">
    <form id="payment-checkout-form" method="POST" action="{{route('payment-checkout')}}">
    @CSRF
        <div class="container">
            <h1 class="main-heading">Checkout Page</h1>
            <div class="row">
                
                <div class="col-lg-8 col-md-12">
                    <!-- Shopping cart table -->
                    <div class="left-part">
                        <div class="shipping-info common-class">
                            <h1 class="info-heading">Shipping Information</h1>
                            <div class="payment-section">
                                
                                    <!-- <div class="payment-method-box">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio1" name="customRadio" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio1">Standard Shipping (€ 5)</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio2" name="customRadio" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio2">Express Shipping (€ 15)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio3" name="customRadio" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio3">Paysera</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="customRadio4" name="customRadio" class="custom-control-input">
                                                    <label class="custom-control-label" for="customRadio4">Bankwire</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="couponCode">Name</label>
                                                <input type="text" name="name" class="form-control" />
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="usr">Phone</label>
                                                <input class="form-control" name="phone" placeholder="" type="text">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="usr">Address</label>
                                                <input class="form-control fr-time-frm" name="address" placeholder="" type="text">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="usr">City</label>
                                                <input class="form-control fr-time-frm" placeholder="" name="city" type="text">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="usr">Country</label>
                                                <select class="form-control" id="sel1" name="country">
                                                    <option value="" selected disabled>Select Country</option>
                                                    @foreach($country as $key=>$value)
                                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="usr">Postal Code</label>
                                                <input class="form-control fr-time-frm" placeholder="" name="zip" type="text">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="row">

                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="usr">Order note</label>
                                                <input class="form-control fr-time-frm" placeholder="" name="" type="text">
                                            </div>
                                        </div>

                                    </div> -->

                                    <div class="row" style="display:none;">
                                        <div class="col-xs-12">
                                            <p class="payment-errors"></p>
                                        </div>
                                    </div>
                                
                            </div>
                        </div>
                    </div>

                    <!-- End -->
                </div>
                @php
                $total=0;
                $additional_amount=0;
                @endphp
                
                @forelse($cart_products as $product)
                @php
                $total+=($product->item_price*$product->quantity);
                
                @endphp
                @empty
                @endforelse
                <div class="col-lg-4 col-md-12">
                    <div class="right-part">
                        <h1 class="info-heading">Order Summery</h1>

                        <div class="price-grp">
                            <div class="summary-item"><span class="text">Subtotal</span><span class="price"><i class="fa fa-gbp" aria-hidden="true"></i>{{$total}}</span></div>
                            <!-- <div class="summary-item"><span class="text">Tax Amount:</span><span class="price">$ 0.00</span></div> -->
                            <div class="summary-item"><span class="text">Shipping Amount:</span><span class="price"><i class="fa fa-gbp" aria-hidden="true"></i> 0.00</span></div>
<!--                            <div class="summary-item"><span class="text">
                                    <span class="custom-control custom-checkbox mr-sm-2 dsp_inblock">
                                        <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                        <label class="custom-control-label" for="customControlAutosizing">Use Wallet Amount</label>
                                    </span>
                                </span><span class="price">€ - 0.00</span></div>-->
                            <div class="summary-item"><span class="text">Payable Amount:</span><span class="price" style="color:#ff0000;"><i class="fa fa-gbp" aria-hidden="true"></i>{{$total}}</span></div>
                            <div class="text-center border_tp">
                                <button type="submit" class="btn btn-success"><span>Continue & Pay</span></button>
                            </div>
                        </div>



                        <!--                                <div class="price-grp p-0 height_scroll">
                                                            <div class="inner_heading_cart">
                                                                <h1>In your cart</h1>
                                                                <p>Lorem ipsum dolor sit amet</p>
                                                            </div>
                                                            <div class="cust-scroll-table">
                                                            <div class="media">
                                                            
                                                                </div>
                                                        </div>
                                                    </div>-->
                    </div>
                </div>


            </div>
            </form>
    </section>
</div>
@endsection

@section('js')

<script>
    $(document).ready(function () {
        $(".cust-scroll-table").niceScroll({touchbehavior: false, cursorcolor: "#2e4f7b", cursoropacitymax: 0.7, cursorwidth: 5, background: "#cccccc", cursorborder: "none", cursorborderradius: "5px", autohidemode: false});
        $(window).scroll(function () {
            $(".cust-scroll-table").getNiceScroll().resize();
        });
        $(window).resize(function () {
            $(".cust-scroll-table").getNiceScroll().resize();
        });
        var nicesx = $(".field-scroll").niceScroll(".field-scroll div", {touchbehavior: true, cursorcolor: "#FF00FF", cursoropacitymax: 0.6, cursorwidth: 24, usetransition: true, hwacceleration: true, autohidemode: "hidden"});
        $(window).scroll(function () {
            $(".field-scroll").getNiceScroll().resize();
        });
        $(window).resize(function () {
            $(".field-scroll").getNiceScroll().resize();
        });
    });
</script>

@endsection