<?php

use Illuminate\Support\Facades\Route;

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
//Fontend
Route::get('/', 'App\Http\Controllers\HomeController@index');
Route::get('/trang-chu', 'App\Http\Controllers\HomeController@index');
Route::post('/tim-kiem', 'App\Http\Controllers\HomeController@search');
Route::get('/tim-kiem', 'App\Http\Controllers\HomeController@search');

//Danh mục sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}', 'App\Http\Controllers\CategoryProduct@show_category_home');
Route::get('/thuong-hieu-san-pham/{brand_id}', 'App\Http\Controllers\BrandProduct@show_brand_home');
Route::get('/chi-tiet-san-pham/{product_id}', 'App\Http\Controllers\ProductController@details_product');
Route::get('/comment/', 'App\Http\Controllers\ProductController@list_comment');
Route::post('/insert-rating/', 'App\Http\Controllers\ProductController@insert_rating');
// cmt
Route::post('/load-comment/', 'App\Http\Controllers\ProductController@load_comment');
Route::post('/send-comment/', 'App\Http\Controllers\ProductController@send_comment');
Route::post('/reply-comment/', 'App\Http\Controllers\ProductController@reply_comment');
Route::get('/delete-comment/{comment_id}', 'App\Http\Controllers\ProductController@delete_comment');


//Backend
Route::get('/admin', 'App\Http\Controllers\AdminController@index');
Route::get('/dashboard', 'App\Http\Controllers\AdminController@show_dashboard');
Route::get('/logout', 'App\Http\Controllers\AdminController@logout');
Route::put('/admin-dashboard', 'App\Http\Controllers\AdminController@dashboard');

//CategoryProduct danh muc sp
Route::get('/add-category-product', 'App\Http\Controllers\CategoryProduct@add_category_product');
Route::get('/all-category-product', 'App\Http\Controllers\CategoryProduct@all_category_product');
Route::get('/edit-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@edit_category_product');
Route::get('/delete-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@delete_category_product');

Route::get('/unactive-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@unactive_category_product');
Route::get('/active-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@active_category_product');

Route::post('/save-category-product', 'App\Http\Controllers\CategoryProduct@save_category_product');
Route::post('/update-category-product/{category_product_id}', 'App\Http\Controllers\CategoryProduct@update_category_product');

//BrandProduct thuong hieu (xuat su)
Route::get('/add-brand-product', 'App\Http\Controllers\BrandProduct@add_brand_product');
Route::get('/all-brand-product', 'App\Http\Controllers\BrandProduct@all_brand_product');
Route::get('/edit-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@edit_brand_product');
Route::get('/delete-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@delete_brand_product');

Route::get('/unactive-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@unactive_brand_product');
Route::get('/active-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@active_brand_product');

Route::post('/save-brand-product', 'App\Http\Controllers\BrandProduct@save_brand_product');
Route::post('/update-brand-product/{brand_product_id}', 'App\Http\Controllers\BrandProduct@update_brand_product');

//Product sanpham
Route::get('/add-product', 'App\Http\Controllers\ProductController@add_product');
Route::get('/all-product', 'App\Http\Controllers\ProductController@all_product');
Route::get('/edit-product/{product_id}', 'App\Http\Controllers\ProductController@edit_product');
Route::get('/delete-product/{product_id}', 'App\Http\Controllers\ProductController@delete_product');

Route::get('/unactive-product/{product_id}', 'App\Http\Controllers\ProductController@unactive_product');
Route::get('/active-product/{product_id}', 'App\Http\Controllers\ProductController@active_product');

Route::post('/save-product', 'App\Http\Controllers\ProductController@save_product');
Route::post('/update-product/{product_id}', 'App\Http\Controllers\ProductController@update_product');

//cart
Route::get('/save-cart', 'App\Http\Controllers\CartController@save_cart');
Route::post('/update-cart', 'App\Http\Controllers\CartController@update_cart');
Route::post('/add-cart-ajax', 'App\Http\Controllers\CartController@add_cart_ajax');
Route::get('/gio-hang', 'App\Http\Controllers\CartController@gio_hang');
Route::get('/show-cart', 'App\Http\Controllers\CartController@show_cart');
Route::get('/del-product/{session_id}', 'App\Http\Controllers\CartController@del_product');
Route::get('/del-all-product', 'App\Http\Controllers\CartController@del_all_product');

//all sp
Route::get('/all-pet', 'App\Http\Controllers\AllProductController@all_pet');

//thanhtoan 
Route::get('/login-checkout', 'App\Http\Controllers\CheckoutController@login_checkout');
Route::get('/logout-checkout', 'App\Http\Controllers\CheckoutController@logout_checkout');
Route::get('/checkout', 'App\Http\Controllers\CheckoutController@checkout');
Route::get('/payment', 'App\Http\Controllers\CheckoutController@payment');
Route::get('/delete-fee', 'App\Http\Controllers\CheckoutController@delete_fee');
Route::post('/add-customer', 'App\Http\Controllers\CheckoutController@add_customer');
Route::post('/login-customer', 'App\Http\Controllers\CheckoutController@login_customer');
Route::post('/order-place', 'App\Http\Controllers\CheckoutController@order_place');
Route::post('/save-checkout-customer', 'App\Http\Controllers\CheckoutController@save_checkout_customer');
Route::post('/calculate-fee', 'App\Http\Controllers\CheckoutController@calculate_fee');
Route::post('/select-ship-home', 'App\Http\Controllers\CheckoutController@select_ship_home');

// order
Route::get('/manage-order', 'App\Http\Controllers\CheckoutController@manage_order');
Route::get('/view-order/{orderId}', 'App\Http\Controllers\CheckoutController@view_order');
Route::get('/delete-order/{orders_id}', 'App\Http\Controllers\CheckoutController@delete_order');

//shipp
Route::get('/ship', 'App\Http\Controllers\ShipProduct@ship');
Route::post('/select-ship', 'App\Http\Controllers\ShipProduct@select_ship');
Route::post('/insert-ship', 'App\Http\Controllers\ShipProduct@insert_ship');
Route::post('/select-feeship', 'App\Http\Controllers\ShipProduct@select_feeship');
Route::post('/update-ship', 'App\Http\Controllers\ShipProduct@update_ship');

