@extends('layouts.main')

@section('content')
<div class="body_content padding-50">
    <section class="cart_main notifi">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 rounded shadow-sm">
                    <!-- Shopping cart table -->
                    <div class="notifi_inner">
                        <div class="notfound">
                            <div class="notfound-404">
                                <h1>Whoops!</h1>
                            </div>
                            <h2>We are sorry, No item found on your cart !</h2>
                            <p>Please click below button for continue to shopping. <i class="icofont-shopping-cart"></i></p>
                            <a href="{{ Route('/') }}" class="btn deflt-btn">Continue to Shopping</a>
                        </div>
                    </div>
                    <!-- End -->
                </div>
            </div>
        </div>
    </section>
</div>
@stop