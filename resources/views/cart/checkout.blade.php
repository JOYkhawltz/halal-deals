@extends('layouts.main')

@section('content') 
@section('css')
<link rel="stylesheet" href="{{URL::asset('public/frontend/custom/datetimepicker/css/bootstrap-datetimepicker.min.css')}}">
<style type="text/css">
    #payment-form{
        display: none;
    }
    #pay{
        display:none;
    }
    #pay_with_paypal{
        display:none;
    }
    #OR{
        display:none;
    }
    #total_payble_amount{
        display: none;
    }
</style>
@stop  

<div class="how_it_works padding-50">
    <section class="checkout_main">

        <div class="container">
            <h1 class="main-heading">Checkout Page</h1>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <!-- Shopping cart table -->
                    <div class="left-part">
                        <?php if($postage=="1"){ ?>
                        <div class="shipping-info common-class" id="address-form">
                            <h1 class="info-heading">Shipping Information</h1>
                            <form id="payment-checkout-form" method="POST" action="{{route('payment-checkout')}}">
                                @CSRF
                                <div class="payment-section">

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


                                    <div class="row" style="display:none;">
                                        <div class="col-xs-12">
                                            <p class="payment-errors"></p>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                        <?php } ?>
                        @php
                        $subtotal=0;
                        $total=0;
                        $shipping_charge=0.00;
                        $additional_amount=0;
                        @endphp

                        @forelse($cart_products as $product)
                        <?php
                        $subtotal += ($product->item_price * $product->quantity);
                        if ($product->type == 'deal') {
                            $advert = App\Advert::findOrFail($product->advert_ID);
                            if ($advert->product->address_required == '1') {
                                $shipping_charge += $advert->product->postage_cost;
                            }
                        }
                        ?>
                        @empty
                        @endforelse
                        <?php
                        $total = $subtotal + $shipping_charge;
                        ?>
                        <div class="shipping-info common-class" <?php if($postage=="1"){ ?> id="payment-form" <?php } ?>>
                            <h1 class="info-heading">Card Information</h1>
                            <form id="card-checkout-form" method="POST" action="{{route('card-checkout')}}">
                                @CSRF
                                <div class="payment-section">

                                    <div class="row">
                                        <input type="hidden" name="card_type" id="card_type">
                                        <input type="hidden" name="total_amount" value="{{$total}}">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="couponCode">Full Name On The Card</label>
                                                <input type="text" class="form-control" name="full_name" placeholder="Enter the name on your card">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="usr">Card Number</label>
                                                <input type="tel" class="form-control" name="number" id="card_number"   placeholder="Enter your card number">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="usr">Expiry Date (MM/YYYY)</label>
                                                <input type="month" class="form-control" name="expiry" placeholder="MM/YYYY"  >
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="usr">CVV</label>
                                                <input type="password" class="form-control" name="cvc" id="cvc" placeholder="CVC" maxlength="3">
                                                <span class="help-block"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" style="display:none;">
                                        <div class="col-xs-12">
                                            <p class="payment-errors"></p>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- End -->
                </div>

                <div class="col-lg-4 col-md-12">
                    <div class="right-part">
                        <h1 class="info-heading">Order Summary</h1>

                        <div class="price-grp">
                            <div class="summary-item"><span class="text">Subtotal</span><span class="price"><i class="fa fa-gbp" aria-hidden="true"></i>{{number_format($subtotal,2)}}</span></div>
                            <!-- <div class="summary-item"><span class="text">Tax Amount:</span><span class="price">$ 0.00</span></div> -->
                            <div class="summary-item"><span class="text">Shipping Amount:</span><span class="price"><i class="fa fa-gbp" aria-hidden="true"></i> {{number_format($shipping_charge,2)}}</span></div>
<!--                            <div class="summary-item"><span class="text">
                                    <span class="custom-control custom-checkbox mr-sm-2 dsp_inblock">
                                        <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                        <label class="custom-control-label" for="customControlAutosizing">Use Wallet Amount</label>
                                    </span>
                                </span><span class="price">€ - 0.00</span></div>-->
                            <div class="summary-item" ><span class="text">Payable Amount:</span><span class="price" style="color:#ff0000;"><i class="fa fa-gbp" aria-hidden="true"></i>{{number_format($total,2)}}</span></div>
                            <div id="total_payble_amount">{{$total}}</div>
                            <?php
                            if($postage=="1"){ ?>
                                <div class="text-center border_tp" id="confirm">
                                    <button type="button" class="btn btn-success" onclick="address_confirm()"><span>Continue</span></button>
                                </div>
                           <?php }?>
                            <div class="text-center border_tp" <?php if($postage=="1"){ ?>id="pay"<?php } ?>>
                                <button type="button" class="btn btn-success" onclick="Pay_product()"><span>Confirm & Pay</span></button>
                            </div>
                            <div class="text-center" <?php if($postage=="1"){ ?>id="OR"<?php } ?>><b>OR</b></div>
                            <div class="text-center" <?php if($postage=="1"){ ?>id="pay_with_paypal"<?php } ?>>
                                <button type="button" class="btn btn-success" onclick="Pay_With_PayPal()"><span>Pay With PayPal</span></button>
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
    </section>
</div>
@endsection

@section('js')
<script src="{{URL::asset('public/frontend/custom/datetimepicker/js/bootstrap-datetimepicker.min.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#card_number").on('keyup', function () {
            var g = GetCardType($(this).val());
            $("#card_type").val(g);
        });
        $('#expiry_date').mask('99/9999');
        $('#cvc').mask('999');
        $('#card_number').mask('9999 9999 9999 9999');
        $('.datepicker').datetimepicker({
                                                format: "mm-yyyy",
                                                autoclose: true,
                                                todayBtn: true,
                                                startDate: new Date(),
                                                minView: 2
                                            });
    });
    
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

        $("#card_number").on('keyup', function () {
            var g = GetCardType($(this).val());
            $("#card_type").val(g);
        });
        $('#expiry_date').mask('99/9999');
        $('#cvc').mask('999');
        $('#card_number').mask('9999 9999 9999 9999');
    });
</script>

@endsection