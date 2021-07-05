<div class="dash-left-menu">
    <ul>
        <li class="{{Route::is('dashboard') ? 'active' : '' }}"><a href="{{ Route('dashboard') }}"><i class="icofont-rocket"></i>Dashboard</a></li>
        @if (Auth::guard('frontend')->user()->type_id === '3')
        <li class="{{(in_array(\Request::route()->getName(),['get-product-list','edit-product','add-product']))?'active':''}}"><a href="{{Route('get-product-list')}}"><i class="icofont-box"></i>Products</a></li>
        <li class="{{(in_array(\Request::route()->getName(),['get-advert-deal-list','add-advert-deal']))?'active':''}}"><a href="{{Route('get-advert-deal-list')}}"><i class="icofont-ticket"></i>Adverts</a></li>
        <li class="{{(in_array(\Request::route()->getName(),['get-advert-voucher-list','add-advert-voucher','advert-voucher-details','advert-voucheredit-details']))?'active':''}}"><a href="{{Route('get-advert-voucher-list')}}"><i class="icofont-ticket"></i>Vouchers</a></li>
        
        @endif
        <li class="{{Route::is('my-profile') ? 'active' : '' }}"><a href="{{Route('my-profile')}}"><i class="icofont-ui-user"></i>My Account</a></li>        
        @php
        $user_id = Auth()->guard('frontend')->user()->id;
        $notification_count=App\Notification::where('notifiers_id','=',$user_id)->wherestatus('0')->count();
        @endphp
        <li class="{{Route::is('notification') ? 'active' : '' }}"><a href="{{Route('notification')}}"><i class="icofont-notification"></i> Notification @if($notification_count>0)(<span class="cst_menu_spn">{{$notification_count}}</span>) @endif</a></li>
        @if (Auth::guard('frontend')->user()->type_id === '3')
        <li class="{{(in_array(\Request::route()->getName(),['order','view-order-details','edit-order-details']))?'active':''}}"><a href="{{Route('order')}}"><i class="icofont-history"></i>Orders </a></li>
        <li class="{{Route::is('withdrawal-wallet','view-withdrawl-history') ? 'active' : '' }}"><a href="{{Route('withdrawal-wallet')}}"><i class="icofont-wallet"></i>Wallet </a></li>
        @endif
        @if (Auth::guard('frontend')->user()->type_id === '4')
        <li class="{{(in_array(\Request::route()->getName(),['customer-order-details','view-order-details']))?'active':''}}"><a href="{{Route('customer-order-details')}}"><i class="icofont-history"></i>Order History </a></li>
        @endif
        <li><a href="{{ Route('logout') }}"><i class="icofont-logout"></i>Log Out</a></li>
    </ul>
</div>
