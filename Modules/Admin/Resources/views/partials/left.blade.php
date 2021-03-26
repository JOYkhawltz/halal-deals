<ul class="page-sidebar-menu  page-header-fixed page-sidebar-menu-hover-submenu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
    <li class="nav-item {{ (Request::route()->getName() === 'admin-dashboard') ? 'active' : '' }}">
        <a href="{{ Route('admin-dashboard') }}" class="nav-link nav-toggle">
            <i class="icon-home"></i>
            <span class="title">Dashboard</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
    </li>
    <li class="nav-item {{ (Request::route()->getName() === 'admin-myprofile') ? 'active' : '' }}">
        <a href="{{ Route('admin-myprofile') }}" class="nav-link nav-toggle">
            <i class="icon-wrench"></i>
            <span class="title">Account Settings</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['cms.index', 'cms.show', 'cms.edit'])) ? 'active' : '' }}">
        <a href="{{ Route('cms.index') }}" class="nav-link nav-toggle">
            <i class="fa fa-picture-o"></i>
            <span class="title">CMS</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['contact.index', 'contact.show'])) ? 'active' : '' }}">
        <a href="{{ Route('contact.index') }}" class="nav-link nav-toggle">
            <i class="fa fa-phone"></i>
            <span class="title">Contacts</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <!--    <li class="nav-item ">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="icon-envelope"></i>
            <span class="title">Emails</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>-->
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-faqs', 'admin-createfaq', 'admin-viewfaq', 'admin-updatefaq'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-faqs') }}" class="nav-link nav-toggle">
            <i class="fa fa-question"></i>
            <span class="title">Faqs</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (Request::route()->getName() === 'admin-settings') ? 'active' : '' }}">
        <a href="{{ Route('admin-settings') }}" class="nav-link nav-toggle">
            <i class="fa fa-cog"></i>
            <span class="title">Global Settings</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-deal-adverts', 'admin-viewadvertdeal'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-deal-adverts') }}" class="nav-link nav-toggle">
            <i class="fa fa-adn"></i>
            <span class="title">Adverts</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-voucher-adverts'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-voucher-adverts') }}" class="nav-link nav-toggle">
            <i class="fa fa-adn"></i>
            <span class="title">Vouchers</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['product-type.index', 'product-type.show', 'product-type.edit', 'product-sub-type.index', 'product-sub-type.show', 'product-sub-type.edit'])) ? 'active' : '' }}">
        <a href="{{ Route('product-type.index') }}" class="nav-link nav-toggle">
            <i class="fa fa-life-ring"></i>
            <span class="title">Product Types</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-notifications'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-notifications') }}" class="nav-link nav-toggle">
            <i class="fa fa-bell"></i>
            <span class="title">Notification</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-products','admin-addproduct', 'admin-viewproduct', 'admin-updateproduct'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-products') }}" class="nav-link nav-toggle">
            <i class="icon-equalizer"></i>
            <span class="title">Products</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-discount','admin-discount-view', 'admin-discount-edit'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-discount') }}" class="nav-link nav-toggle">
            <i class="fa fa-ticket" aria-hidden="true"></i>
            <span class="title">Discount Management</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-orders','admin-orderlistdetail','admin-vieworderdetail'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-orders') }}" class="nav-link nav-toggle">
            <i class="fa fa-history"></i>
            <span class="title">Orders</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-wallet-management','admin-withdrawlrequestdetail'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-wallet-management') }}" class="nav-link nav-toggle">
            <i class="fa fa-money"></i>
            <span class="title">Wallet Management</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['seo.index', 'seo.show', 'seo.edit'])) ? 'active' : '' }}">
        <a href="{{ Route('seo.index') }}" class="nav-link nav-toggle">
            <i class="icon-list"></i>
            <span class="title">SEO</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-emails', 'admin-viewemail', 'admin-updateemail'])) ? 'active' : '' }}">
        <a href="{{ Route('admin-emails') }}" class="nav-link nav-toggle">
            <i class="icon-envelope"></i>
            <span class="title">Emails</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['static-page.index', 'static-page.show', 'static-page.edit'])) ? 'active' : '' }}">
        <a href="{{ Route('static-page.index') }}" class="nav-link nav-toggle">
            <i class="icon-layers"></i>
            <span class="title">Static Pages</span>
            <span class="selected"></span>
            <span class="arrow"></span>
        </a>
    </li>
    <li class="nav-item {{ (in_array(Route::currentRouteName(), ['customer.index', 'customer.create', 'customer.show', 'customer.edit', 'vendor.index', 'vendor.create', 'vendor.show', 'vendor.edit'])) ? 'active' : '' }}">
        <a href="javascript:;" class="nav-link nav-toggle">
            <i class="fa fa-users"></i>
            <span class="title">Users</span>
            <span class="selected"></span>
            <span class="arrow open"></span>
        </a>
        <ul class="sub-menu">
            <li class="nav-item {{ (in_array(Route::currentRouteName(), ['admin-staff.index', 'admin-staff.create', 'admin-staff.show', 'admin-staff.edit'])) ? 'active' : '' }}">
                <a href="{{ Route('admin-staff.index') }}" class="nav-link ">
                    <i class="icon-user-following"></i>
                    <span class="title">HD Staff</span>
                </a>
            </li>
            <li class="nav-item {{ (in_array(Route::currentRouteName(), ['vendor.index', 'vendor.create', 'vendor.show', 'vendor.edit'])) ? 'active' : '' }}">
                <a href="{{ Route('vendor.index') }}" class="nav-link ">
                    <i class="icon-user-following"></i>
                    <span class="title">Business Manager</span>
                </a>
            </li>
            <li class="nav-item {{ (in_array(Route::currentRouteName(), ['customer.index', 'customer.create', 'customer.show', 'customer.edit'])) ? 'active' : '' }}">
                <a href="{{ Route('customer.index') }}" class="nav-link ">
                    <i class="icon-users"></i>
                    <span class="title">Customer</span>
                    <span class="selected"></span>
                </a>
            </li>
        </ul>
    </li>
</ul>