<ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
    <li class="nav-item {{ (Request::route()->getName() === 'staff-dashboard') ? 'active' : '' }}">
        <a href="{{ Route('staff-dashboard') }}" class="nav-link nav-toggle">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
    </li>
    <li class="nav-item {{ (Request::route()->getName() === 'staff-myprofile') ? 'active' : '' }}">
        <a href="{{ Route('staff-myprofile') }}" class="nav-link nav-toggle">
            <i class="icon-wrench"></i>
            <span class="title">Account Settings</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['staff-notifications'])) ? 'active' : '' }}">
        <a href="{{ Route('staff-notifications') }}" class="nav-link nav-toggle">
            <i class="fa fa-bell"></i>
            <span class="title">Notification</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['staff-deal-adverts', 'staff-viewadvertdeal','staff-voucher-adverts', 'staff-viewadvertvoucher'])) ? 'active' : '' }}">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-adn"></i>
            <span class="title">Adverts</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item {{ (in_array(Route::currentRouteName(), ['staff-deal-adverts', 'staff-viewadvertdeal'])) ? 'active' : '' }}">
                <a href="{{ Route('staff-deal-adverts') }}" class="nav-link ">
                    <i class=""></i>
                    <span class="title">Deals</span>
                </a>
            </li>
            <li class="nav-item {{ (in_array(Route::currentRouteName(), ['staff-voucher-adverts', 'staff-viewadvertvoucher'])) ? 'active' : '' }}">
                <a href="{{ Route('staff-voucher-adverts') }}" class="nav-link ">
                    <i class=""></i>
                    <span class="title">Voucher</span>
                </a>
            </li>
        </ul>
    </li>

    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['staff-products','staff-addproduct', 'staff-viewproduct', 'staff-updateproduct'])) ? 'active' : '' }}">
        <a href="{{ Route('staff-products') }}" class="nav-link nav-toggle">
            <i class="icon-equalizer"></i>
            <span class="title">Products</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['staff-vendor.index','staff-vendor.show', 'staff-vendor.edit'])) ? 'active' : '' }}">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-users"></i>
            <span class="title">Users</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item {{ (in_array(Route::currentRouteName(), ['staff-vendor.index','staff-vendor.show', 'staff-vendor.edit'])) ? 'active' : '' }}">
                <a href="{{ Route('staff-vendor.index') }}" class="nav-link ">
                    <i class="icon-user-following"></i>
                    <span class="title">Business Manager</span>
                </a>
            </li>
        </ul>
    </li>
</ul>