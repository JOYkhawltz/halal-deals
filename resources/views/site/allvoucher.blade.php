@extends('layouts.main')
@section('content')
<section class="main-body-section">
    <div class="container">
        @if(count($vouchers)>0)
        <div class="body-box">
            <h2>Vouchers</h2>
            <div class="body-box-inner">
                <div class="row">
                    @foreach($vouchers as $voucher)
                    <?php
                    $status = 1;
                    $business = App\Business::select('user_id')->where('bus_ID', '=', $voucher->bus_ID)->first();
                    $user = App\User::where('id', '=', $business->user_id)->first();
                    if ($voucher->spec_times == '1') {
                        $count = App\Advert::where('advert_ID', $voucher->advert_ID)->where('date_start', '<=', \Carbon\Carbon::now(get_local_time())->format('Y-m-d H:i:s'))->where('date_finish', '>=', \Carbon\Carbon::now(get_local_time())->format('Y-m-d H:i:s'))->count();
                        if ($count > 0) {
                            $status = 1;
                        } else {
                            $status = 0;
                        }
                    }
                    ?>
                    @if($status==1)
                    <div class="col-xl-4 col-lg-4 col-sm-4 item mb-3">
                        <div class="product-box">

                            <div class="product-info voucher_bx">

                                <div class="media">
                                    <div class="media-body">
                                        <h1>{{str_limit($voucher->title,15)}}</h1>
                                        <div class="off-price"><span class="value_on">Value</span><span class="value_two"><i class="fa fa-gbp" aria-hidden="true"></i>{{$voucher->voucher_amount}}</span></div>
                                    </div>
                                    <div class="media-right">
                                        @if(isset($user->image))
                                        <img src="{{ URL::asset('public/uploads/frontend/profile_picture/thumb/'.$user->image) }}" class="voucher_img">
                                        @else
                                        <img src="{{ URL::asset('public/frontend/images/showvoucher.png') }}" class="voucher_img">
                                        @endif
                                        @if($voucher->other_options_available=='1'&&$voucher->new_cust_only=='1')
                                        @if (Auth()->guard('frontend')->guest())
                                        <a href="javascript:;" onclick="showSigninModal();" class="deflt-btn">Get Voucher</a>
                                        @else
                                        <a href="{{Route('voucher-details',['id'=>$voucher->advert_ID])}}" class="deflt-btn">Get Voucher</a>
                                        @endif
                                        @else
                                        <a href="{{Route('voucher-details',['id'=>$voucher->advert_ID])}}" class="deflt-btn">Get Voucher</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
            @endif
        </div>
</section>
@stop