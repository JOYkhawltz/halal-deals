<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */

Route::prefix('admin')->group(function() {
    Route::middleware(['admin_not_logged_in'])->group(function () {
        Route::get('/', 'AuthController@get_login');
        Route::get('login', 'AuthController@get_login')->name('admin-login');
        Route::post('login', 'AuthController@post_login')->name('admin-login');
        Route::put('forgotpassword', 'AuthController@post_forgot_password')->name('admin-forgotpassword');
        Route::get('lockscreen', 'AuthController@get_lockscreen')->name('admin-lockscreen');
        Route::post('lockscreen', 'AuthController@post_lockscreen')->name('admin-lockscreen');
    });

    Route::middleware(['admin_logged_in'])->group(function () {
        Route::get('logout', 'AuthController@logout')->name('admin-logout');

        Route::get('dashboard', 'DashboardController@index')->name('admin-dashboard');
        Route::get('admin-total-sell', ['uses' => 'DashboardController@total_sell_chart', 'as' => 'admin-total-sell']);
        Route::get('profit-per-month', ['uses' => 'DashboardController@profit_per_month', 'as' => 'profit-per-month']);

        Route::get('myprofile', 'MyprofileController@get_myprofile')->name('admin-myprofile');
        Route::put('myprofile', 'MyprofileController@post_myprofile')->name('admin-myprofile');
        Route::put('changepassword', 'MyprofileController@post_changepassword')->name('admin-changepassword');

        Route::resource('cms', 'CmsController')->only(['index', 'show', 'edit', 'update']);

        Route::resource('contact', 'ContactController')->only(['index', 'show', 'update']);

        Route::resource('customer', 'CustomerController');

        Route::resource('product-type', 'ProducttypeController')->except('destroy');

        Route::resource('product-sub-type', 'ProductsubtypeController')->except('destroy');

        Route::resource('seo', 'SeoController')->only(['index', 'show', 'edit', 'update']);

        Route::get('settings', 'SettingsController@index')->name('admin-settings');
        Route::put('settings', 'SettingsController@update')->name('admin-settings');

        Route::resource('static-page', 'StaticpageController')->only(['index', 'show', 'edit', 'update']);

        Route::resource('vendor', 'VendorController');
        Route::resource('admin-staff', 'StaffController');
        
        Route::get('admin-emails', ['uses' => 'EmailController@index', 'as' => 'admin-emails']);
        Route::get('admin-viewemail/{id}', ['uses' => 'EmailController@view', 'as' => 'admin-viewemail']);
        Route::get('admin-updateemail/{id}', ['uses' => 'EmailController@get_update', 'as' => 'admin-updateemail']);
        Route::post('admin-updateemail/{id}', ['uses' => 'EmailController@post_update', 'as' => 'admin-updateemail']);
        
        Route::get('admin-faqs', ['uses' => 'FaqController@index', 'as' => 'admin-faqs']);
        Route::get('admin-createfaq', ['uses' => 'FaqController@get_create', 'as' => 'admin-createfaq']);
        Route::post('admin-createfaq', ['uses' => 'FaqController@post_create', 'as' => 'admin-createfaq']);
        Route::get('admin-viewfaq/{id}', ['uses' => 'FaqController@view', 'as' => 'admin-viewfaq']);
        Route::get('admin-updatefaq/{id}', ['uses' => 'FaqController@get_update', 'as' => 'admin-updatefaq']);
        Route::post('admin-updatefaq/{id}', ['uses' => 'FaqController@post_update', 'as' => 'admin-updatefaq']);
        Route::get('admin-deletefaq', ['uses' => 'FaqController@delete', 'as' => 'admin-deletefaq']);

        Route::get('admin-deal-adverts', ['uses' => 'AdvertController@deal_index', 'as' => 'admin-deal-adverts']);
        Route::get('admin-voucher-adverts', ['uses' => 'AdvertController@voucher_index', 'as' => 'admin-voucher-adverts']);
        Route::get('advertdeal-list-datatable', ['uses' => 'AdvertController@get_advertdeal_list_datatable', 'as' => 'advertdeal-list-datatable']);
        Route::get('advertvoucher-list-datatable', ['uses' => 'AdvertController@get_advertvoucher_list_datatable', 'as' => 'advertvoucher-list-datatable']);
        Route::get('advertvoucherdetail-list-datatable/{id}', ['uses' => 'AdvertController@get_advertvoucherdetail_list_datatable', 'as' => 'advertvoucherdetail-list-datatable']);
//        Route::get('admin-addadvert', ['uses' => 'AdvertController@add_advert', 'as' => 'admin-addadvert']);
//        Route::post('admin-addadvert', ['uses' => 'AdvertController@post_add_advert', 'as' => 'admin-addadvert']);
        Route::get('admin-viewadvertdeal/{id}', ['uses' => 'AdvertController@viewdeal', 'as' => 'admin-viewadvertdeal']);
        Route::get('admin-viewadvertvoucher/{id}', ['uses' => 'AdvertController@viewvoucher', 'as' => 'admin-viewadvertvoucher']);
//        Route::get('admin-updateadvert/{id}', ['uses' => 'AdvertController@get_update', 'as' => 'admin-updateadvert']);
//        Route::put('admin-edit-advert',['uses' =>  'AdvertController@post_editadvert', 'as' =>'admin-post-editadvert']);
        Route::delete('admin-deleteadvert/{id}', ['uses' => 'AdvertController@delete', 'as' => 'admin-deleteadvert']);
        Route::get('get-price', ['uses' =>'AdvertController@get_price', 'as' =>'get-cost-price']);
        Route::get('additonal-discount', ['uses' => 'AdvertController@additonal_discount', 'as' =>'additonal-discount']);
        Route::get('product-list', ['uses' => 'AdvertController@product_list', 'as' =>'product-list']);
        
        Route::get('admin-products', ['uses' => 'ProductController@index', 'as' => 'admin-products']);
        Route::get('admin-viewproduct/{id}', ['uses' => 'ProductController@view', 'as' => 'admin-viewproduct']);
        Route::get('admin-products-list-datatable', ['uses' => 'ProductController@get_products_list_datatable', 'as' => 'admin-products-list-datatable']);
        Route::get('admin-addproduct', ['uses' => 'ProductController@add_product', 'as' => 'admin-addproduct']);
        Route::post('admin-addproduct', ['uses' => 'ProductController@post_add_product', 'as' => 'admin-addproduct']);
        Route::get('admin-updateproduct/{id}', ['uses' => 'ProductController@get_update', 'as' => 'admin-updateproduct']);
        Route::post('admin-updateproduct/{id}', ['uses' => 'ProductController@post_update', 'as' => 'admin-updateproduct']);
        Route::delete('admin-deleteproduct/{id}', ['uses' => 'ProductController@delete', 'as' => 'admin-deleteproduct']);
        Route::post('admin-product-photos', ['uses' => 'ProductController@product_photos', 'as' => 'admin-product-photos']);
        Route::any('admin-showphotos', ['uses' => 'ProductController@showimages', 'as' => 'admin-showphotos']);
        Route::get('get-subtype', 'ProductController@get_subtype')->name('get-subtype');
        Route::get('get-type', 'ProductController@get_type')->name('get-type');
        Route::get('get-discounted-price', 'ProductController@get_discounted_price')->name('get-discounted-price');
        
        Route::get('admin-notifications', ['uses' => 'NotificationController@index', 'as' => 'admin-notifications']);
        Route::get('changenotistatus', ['uses' => 'NotificationController@changenotistatus', 'as' => 'changenotistatus']);
        Route::get('load-notification', 'NotificationController@load_notification')->name('load-notification');
        
        Route::get('admin-orders', ['uses' => 'OrderController@index', 'as' => 'admin-orders']);
        Route::get('admin-orderlist-datatable', ['uses' => 'OrderController@get_order_list_datatable', 'as' => 'admin-orderlist-datatable']);
        Route::get('admin-orderdetail-datatable/{o_id}', ['uses' => 'OrderController@get_order_details_datatable', 'as' => 'admin-orderdetail-datatable']);
        Route::get('admin-orderlistdetail/{ID}', ['uses' => 'OrderController@order_details', 'as' => 'admin-orderlistdetail']);
        Route::get('admin-vieworderdetail/{ID}', ['uses' => 'OrderController@show', 'as' => 'admin-vieworderdetail']);
        
        Route::get('admin-wallet-management', ['uses' => 'WalletController@index', 'as' => 'admin-wallet-management']);
        Route::get('admin-withdrawlrequestlist-datatable', ['uses' => 'WalletController@get_withdrawl_list_datatable', 'as' => 'admin-withdrawlrequestlist-datatable']);
        Route::get('admin-withdrawlrequestdetail/{ID}', ['uses' => 'WalletController@show', 'as' => 'admin-withdrawlrequestdetail']);
        Route::post('admin-addpayment/{id}', ['uses' => 'WalletController@add_payment', 'as' => 'admin-addpayment']);

        Route::get('admin-discount', ['uses' => 'DiscountController@index', 'as' => 'admin-discount']);
        Route::get('admin-discount-view/{id}', ['uses' => 'DiscountController@view', 'as' => 'admin-discount-view']);
        Route::get('admin-discount-edit/{id}', ['uses' => 'DiscountController@get_edit', 'as' => 'admin-discount-edit']);
        Route::post('admin-discount-edit/{id}', ['uses' => 'DiscountController@post_edit', 'as' => 'admin-discount-edit']);
        // Route::post('admin-model-category-delete/{id}', ['uses' => 'DiscountController@delete', 'as' => 'admin-model-category-delete']);
        // Route::get('admin-model-category-create', ['uses' => 'DiscountController@get_create', 'as' => 'admin-model-category-create']);
        // Route::post('admin-model-category-create', ['uses' => 'DiscountController@post_create', 'as' => 'admin-model-category-create']);
    });
});
