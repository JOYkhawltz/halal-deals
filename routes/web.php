<?php
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
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

Route::middleware(['web'])->group(function () {
    Route::get('/', 'SiteController@index')->name('/');
    Route::get('about-us', 'SiteController@get_static_page')->name('about-us');
    Route::get('how-it-works', 'SiteController@get_static_page')->name('how-it-works');
    Route::get('privacy-policy', 'SiteController@get_static_page')->name('privacy-policy');
    Route::get('terms-condition', 'SiteController@get_static_page')->name('terms-condition');
    Route::get('help', 'SiteController@get_static_page')->name('help');
    Route::get('contact-us', 'SiteController@get_contactus')->name('contact-us');
    Route::post('contact-us', 'SiteController@post_contact')->name('contact-us');
    Route::get('faq', 'SiteController@get_faq')->name('get-faq');
    /*     * ******************** Cart ************************ */

    Route::get('cart', ['uses' => 'CartController@index', 'as' => 'cart']);
    Route::post('add-cart', ['uses' => 'CartController@add_to_cart', 'as' => 'add-cart']);
    Route::post('cart-update', ['uses' => 'CartController@cart_update', 'as' => 'cart-update']);
    Route::post('remove-cart', ['uses' => 'CartController@remove_from_cart', 'as' => 'remove-cart']);

    /*     * ***********************Search Controller***************************** */
    Route::get('search-coupon', 'SearchController@index')->name('search-coupon');
    Route::get('hot-offers', 'SearchController@hot_offers')->name('hot-offers');
    Route::get('fetch-subcategory', 'SearchController@get_subcategory')->name('fetch-subcategory');
    Route::get('fetch-head-subcategory', 'SearchController@get_head_subcategory')->name('fetch-head-subcategory');
    Route::get('get-coupon-search', 'SearchController@get_coupon_search')->name('get-coupon-search');
    Route::post('post-coupon-search', 'SearchController@post_coupon_search')->name('post-coupon-search');
    Route::post('post-hotdeal-search', 'SearchController@post_hotdeal_search')->name('post-hotdeal-search');
    Route::get('advert-details/{id}', 'SearchController@get_advert_details')->name('advert-details');
    Route::get('voucher-details/{id}', 'SiteController@voucher_details')->name('voucher-details');
    Route::get('show-voucher', 'SiteController@show_voucher')->name('show-voucher');
    Route::middleware(['user_not_logged_in'])->group(function () {
        Route::post('signup', 'SiteController@post_signup')->name('signup');
        Route::post('social-signup', 'SiteController@post_social_signup')->name('social-signup');
        Route::get('active-account/{id}/{token}', 'SiteController@get_active_account')->name('active-account');
        Route::post('resend-active-token', 'SiteController@resend_active_token')->name('resend-active-token');
        Route::post('login', 'SiteController@post_login')->name('login');
        Route::get('login/{name}', 'SiteController@redirectToProvider');
        Route::get('login/{name}/callback', 'SiteController@handleProviderCallback');
        Route::put('forgot-password', 'SiteController@post_forgot_password')->name('forgot-password');
        Route::get('reset-password/{id}/{token}', 'SiteController@get_reset_password')->name('reset-password');
        Route::put('set-password', 'SiteController@post_reset_password')->name('set-password');
        Route::get('business-signup', 'SiteController@business_signup')->name('business-signup');
    });

    Route::middleware(['user_logged_in'])->group(function () {
        Route::get('logout', 'SiteController@logout')->name('logout');
        Route::get('dashboard', 'UserController@get_dashboard')->name('dashboard');
        Route::get('profile', 'UserController@edit_profile')->name('my-profile');
        Route::post('profile', 'UserController@post_profile')->name('post-myprofile');
        Route::get('notification', 'UserController@notification')->name('notification');
        Route::get('read-notification/{id}', 'UserController@read_notification')->name('read-notification');
        Route::get('load-notification', 'UserController@load_notification')->name('load-notification');
        Route::get('delete-notification/{id}', 'UserController@delete_notification')->name('delete-notification');
        Route::post('post-reset-password', 'UserController@reset_password')->name('post-reset-password');
        Route::get('countnotification', 'UserController@countnotification')->name('countnotification');
        Route::get('total-sell', ['uses' => 'UserController@total_sell_chart', 'as' => 'total-sell']);
        Route::get('profit-per-month', ['uses' => 'UserController@profit_per_month', 'as' => 'profit-per-month']);
        
        /*         * ************************ ProductController *********************************** */
        Route::get('product-list', 'ProductController@get_product_list')->name('get-product-list');
        Route::get('add-product', 'ProductController@get_add_product')->name('add-product');
        Route::post('product-photo', 'ProductController@product_photos')->name('product-photo');
        Route::post('add-product', 'ProductController@post_add_product')->name('add-product');
        Route::get('edit-product/{id}', 'ProductController@get_edit_product')->name('edit-product');
        Route::get('show-images', 'ProductController@showimages')->name('show-images');
        Route::get('get-subtype', 'ProductController@get_subtype')->name('get-subtype');
        Route::put('edit-product', 'ProductController@post_edit_product')->name('post-edit-product');
        Route::delete('delete-product', 'ProductController@delete_product')->name('delete-product');
        Route::get('get-discounted-price', 'ProductController@get_discounted_price')->name('get-discounted-price');
        /*         * ************************ AdvertController *********************************** */
        Route::get('get-advert-deal-list', 'AdvertController@get_advert_deal_list')->name('get-advert-deal-list');
        Route::get('get-advert-voucher-list', 'AdvertController@get_advert_voucher_list')->name('get-advert-voucher-list');
        Route::get('add-advert-deal', 'AdvertController@get_add_advert_deal')->name('add-advert-deal');
        Route::post('add-advert-deal', 'AdvertController@post_add_advert_deal')->name('add-advert-deal');
        Route::get('add-advert-voucher', 'AdvertController@get_add_advert_voucher')->name('add-advert-voucher');
        Route::post('add-advert-voucher', 'AdvertController@post_add_advert_voucher')->name('add-advert-voucher');
        Route::get('advert-voucher-details/{id}', 'AdvertController@voucher_details')->name('advert-voucher-details');
        Route::get('advert-voucheredit-details/{id}', 'AdvertController@voucheredit_details')->name('advert-voucheredit-details');
        Route::post('advert-voucheredit-details/{id}', 'AdvertController@post_voucheredit_details')->name('advert-voucheredit-details');
        Route::post('search-voucher','AdvertController@search_voucher')->name('search-voucher');
        Route::get('get-price', 'AdvertController@get_price')->name('get-price');
        Route::get('edit-advert/{id}', 'AdvertController@get_edit_advert')->name('edit-advert');
        Route::put('edit-advert', 'AdvertController@post_edit_advert')->name('post-edit-advert');
        Route::delete('delete-advert', 'AdvertController@delete_advert')->name('delete-advert');
        Route::get('additonal-discount', 'AdvertController@additonal_discount')->name('additonal-discount');
        /*         * ******************** Cart ************************ */
        Route::get('checkout', ['uses' => 'CartController@checkout', 'as' => 'checkout']);

        Route::Post('payment-checkout',['uses'=>'PaymentController@payment_checkout','as'=>'payment-checkout']);
        Route::Post('card-checkout',['uses'=>'PaymentController@card_checkout','as'=>'card-checkout']);
        Route::Post('paypal-checkout',['uses'=>'PaymentController@paypal_checkout','as'=>'paypal-checkout']);
        Route::get('express-checkout-success',['uses' => 'PaymentController@express_checkout_success','as'=>'express-checkout-success']);
        Route::get('express-checkout-fails',['uses' => 'PaymentController@express_checkout_fails','as'=>'express-checkout-fails']);
        
        Route::get('order', 'OrderController@index')->name('order');
        Route::get('view-order-details/{id}', 'OrderController@view_order_details')->name('view-order-details');

        Route::get('edit-order-details/{id}', 'OrderController@view_order_details')->name('edit-order-details');

        Route::get('customer-order-details','CustomerorderController@index')->name('customer-order-details');

        Route::get('edit-order-details/{id}', 'OrderController@edit_order_details')->name('edit-order-details');
        Route::post('update-order-status/{id}', 'OrderController@update_order_status')->name('update-order-status');

        Route::get('withdrawal-wallet',['uses'=>'WithdrawalController@index','as'=>'withdrawal-wallet']);
        Route::post('withdrawl-request',['uses'=>'WithdrawalController@withdrawl_request','as'=>'withdrawl-request']);
        Route::get('view-withdrawl-history/{id}',['uses'=>'WithdrawalController@withdrawl_history','as'=>'view-withdrawl-history']);

    });
});
