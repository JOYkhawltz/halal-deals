@extends('layouts.main')
@section('content')   
<div class="body_content padding-50">
    <section class="cart_bx py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-9">
                    <h1 class="mn_heading_cart">My Cart</h1>
                    <table id="cart" class="table nw_table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th style="width:10%; text-align: center;">Remove</th>
                                <th style="width:40%">Advert </th>
                                <th style="width:10%; text-align: center;">quantity </th>
                                <th style="width:22%" class="text-center">Total</th>

                            </tr>
                        </thead>

                        <tbody>

                            @php
                            $total=0;
                            @endphp
                            @CSRF
                            @forelse($carts as $cart)
                            @php
                            $total+=($cart->item_price*$cart->quantity);
                            $advert=App\Advert::where('advert_ID','=',$cart->AdvertDetails->advert_ID)->first();
                            $business=App\Business::select('user_id')->where('bus_ID','=',$advert->bus_ID)->first();
                            $user=App\User::where('id','=',$business->user_id)->first();

                            @endphp

                            <tr>
                                <td class="actions text-center" data-th="">

                                    <a href="javascript:void(0);" onclick="removeCart('{{$cart->advert_ID}}', this);"><button class="btn btn-danger btn-sm">x</button></a>								
                                </td>
                                <td data-th="Product">
                                    <div class="row">
                                        <div class="col-sm-2 hidden-xs">
                                            @if($cart->type=='deal')
                                            @if(isset($cart->AdvertDetails->product->defaultPic->image_name)&&!empty($cart->AdvertDetails->product->defaultPic->image_name))
                                            <div class="brand-logo"><img src="{{ URL::asset('public/uploads/frontend/product/preview/'.$cart->AdvertDetails->product->defaultPic->image_name) }}" height="50" width="50"></div>
                                            @else
                                            <div class="brand-logo"><img src="{{ URL::asset('public/frontend/images/product1.png') }}"></div>
                                            @endif
                                            @else
                                            <div class="brand-logo"><img src="{{ URL::asset('public/uploads/frontend/profile_picture/thumb/'.$user->image) }}" height="50" width="50"></div>
                                            @endif

                                        </div>
                                        <div class="col-sm-10">
                                            <h4 class="nomargin nw_txt_bold">{{isset($cart->AdvertDetails->title)?$cart->AdvertDetails->title:''}}</h4>
                                            <p>({{$cart->type}})</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center">{{$cart->quantity}}</td>
                                <td data-th="Subtotal nw_txt_bold" class="text-center"><i class="fa fa-gbp" aria-hidden="true"></i>{{number_format((($cart->item_price)*$cart->quantity),2)}}</td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="5"> No product found in cart.</td>  
                            </tr>

                            @endforelse
                        </tbody>

                    </table>


                    <!--                    <div class="row mb-4 border-topy">
                                            <div class="col-sm-6">
                                                <div class="input-group cart_gtp">
                                                    <input type="text" class="form-control" placeholder="coupon code" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                    <div class="input-group-append">
                                                        <button class="btn deflt-btn" type="button">apply coupon</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 text-right">
                                                <a href="#" class="btn deflt-btn">Update cart</a>
                                            </div>
                                        </div>-->
                    <div class="row justify-content-end">
                        <div class="col-sm-6">
                            <div class="summary">
                                <h3 class="cart_heading">Cart totals</h3>
                                <div class="summary-item"><span class="text">Subtotal</span><span class="price" id="sub_total_price"><i class="fa fa-gbp" aria-hidden="true"></i>{{number_format(($total),2)}}</span></div>
                                <div class="summary-item mb-3"><span class="text">Total</span><span class="price" id="total_price"><i class="fa fa-gbp" aria-hidden="true"></i>{{number_format(($total),2)}}</span></div>
                                @if (Auth()->guard('frontend')->guest())
                                <a href="javascript:;" onclick="showSigninModal();"> <button type="button" class="btn deflt-btn btn-lg btn-block">proceed to checkout</button></a>
                                @else
                                <a href="{{Route('checkout')}}"> <button type="button" class="btn deflt-btn btn-lg btn-block">proceed to checkout</button></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection

