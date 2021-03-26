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

Route::prefix('staff')->group(function() {
    Route::middleware(['staff_not_logged_in'])->group(function () {
        Route::get('/', 'AuthController@get_login');
        Route::get('login', 'AuthController@get_login')->name('staff-login');
        Route::post('login', 'AuthController@post_login')->name('staff-login');
        Route::put('forgotpassword', 'AuthController@post_forgot_password')->name('staff-forgotpassword');
        Route::get('lockscreen', 'AuthController@get_lockscreen')->name('staff-lockscreen');
        Route::post('lockscreen', 'AuthController@post_lockscreen')->name('staff-lockscreen');
    });

    Route::middleware(['staff_logged_in'])->group(function () {
        Route::get('logout', 'AuthController@logout')->name('staff-logout');

        Route::get('dashboard', 'DashboardController@index')->name('staff-dashboard');

        Route::get('myprofile', 'MyprofileController@get_myprofile')->name('staff-myprofile');
        Route::put('myprofile', 'MyprofileController@post_myprofile')->name('staff-myprofile');
        Route::put('changepassword', 'MyprofileController@post_changepassword')->name('staff-changepassword');



        Route::resource('staff-vendor', 'VendorController');

        Route::get('staff-deal-adverts', ['uses' => 'AdvertController@deal_index', 'as' => 'staff-deal-adverts']);
        Route::get('staff-voucher-adverts', ['uses' => 'AdvertController@voucher_index', 'as' => 'staff-voucher-adverts']);
        Route::get('advertdeal-list-datatable', ['uses' => 'AdvertController@get_advertdeal_list_datatable', 'as' => 'advertdeal-list-datatable']);
        Route::get('advertvoucher-list-datatable', ['uses' => 'AdvertController@get_advertvoucher_list_datatable', 'as' => 'advertvoucher-list-datatable']);
        Route::get('advertvoucherdetail-list-datatable/{id}', ['uses' => 'AdvertController@get_advertvoucherdetail_list_datatable', 'as' => 'advertvoucherdetail-list-datatable']);
//        Route::get('staff-adverts', ['uses' => 'AdvertController@index', 'as' => 'staff-adverts']);
//        Route::get('admin-adverts-list-datatable', ['uses' => 'AdvertController@get_adverts_list_datatable', 'as' => 'admin-adverts-list-datatable']);
//        Route::get('staff-addadvert', ['uses' => 'AdvertController@add_advert', 'as' => 'staff-addadvert']);
//        Route::post('staff-addadvert', ['uses' => 'AdvertController@post_add_advert', 'as' => 'staff-addadvert']);
        Route::get('staff-viewadvertdeal/{id}', ['uses' => 'AdvertController@viewdeal', 'as' => 'staff-viewadvertdeal']);
        Route::get('staff-viewadvertvoucher/{id}', ['uses' => 'AdvertController@viewvoucher', 'as' => 'staff-viewadvertvoucher']);
//        Route::get('staff-viewadvert/{id}', ['uses' => 'AdvertController@view', 'as' => 'staff-viewadvert']);
//        Route::get('staff-updateadvert/{id}', ['uses' => 'AdvertController@get_update', 'as' => 'staff-updateadvert']);
//        Route::put('staff-edit-advert',['uses' =>  'AdvertController@post_editadvert', 'as' =>'staff-post-editadvert']);
//        Route::delete('staff-deleteadvert/{id}', ['uses' => 'AdvertController@delete', 'as' => 'staff-deleteadvert']);
        Route::get('get-price', ['uses' => 'AdvertController@get_price', 'as' => 'get-cost-price']);
        Route::get('additonal-discount', ['uses' => 'AdvertController@additonal_discount', 'as' => 'additonal-discount']);
        Route::get('product-list', ['uses' => 'AdvertController@product_list', 'as' => 'product-list']);

        Route::get('staff-products', ['uses' => 'ProductController@index', 'as' => 'staff-products']);
        Route::get('staff-viewproduct/{id}', ['uses' => 'ProductController@view', 'as' => 'staff-viewproduct']);
        Route::get('admin-products-list-datatable', ['uses' => 'ProductController@get_products_list_datatable', 'as' => 'admin-products-list-datatable']);
        Route::get('staff-addproduct', ['uses' => 'ProductController@add_product', 'as' => 'staff-addproduct']);
        Route::post('staff-addproduct', ['uses' => 'ProductController@post_add_product', 'as' => 'staff-addproduct']);
        Route::get('staff-updateproduct/{id}', ['uses' => 'ProductController@get_update', 'as' => 'staff-updateproduct']);
        Route::post('staff-updateproduct/{id}', ['uses' => 'ProductController@post_update', 'as' => 'staff-updateproduct']);
//        Route::delete('staff-deleteproduct/{id}', ['uses' => 'ProductController@delete', 'as' => 'staff-deleteproduct']);
        Route::post('staff-product-photos', ['uses' => 'ProductController@product_photos', 'as' => 'staff-product-photos']);
        Route::any('staff-showphotos', ['uses' => 'ProductController@showimages', 'as' => 'staff-showphotos']);

        Route::get('staff-notifications', ['uses' => 'NotificationController@index', 'as' => 'staff-notifications']);
        Route::get('changenotistatus', ['uses' => 'NotificationController@changenotistatus', 'as' => 'changenotistatus']);
        Route::get('load-notification', 'NotificationController@load_notification')->name('load-notification');
    });
});
