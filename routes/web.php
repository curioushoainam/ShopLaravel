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

Route::get('/','PagesController@getHome');

Route::get('trang-chu', 'PagesController@getHome')->name('home');

Route::get('loai-san-pham/{idType}', 'PagesController@getProduct')->name('productType');
Route::get('chi-tiet-san-pham/{id}', 'PagesController@getDetail')->name('detail');

Route::get('gioi-thieu', 'PagesController@getAbout')->name('about');

Route::get('lien-he', 'PagesController@getContact')->name('contact');

Route::get('them-vao-gio-hang/{id}', 'PagesController@getAddToCart')->name('addtocart');
Route::get('xoa-sp-khoi-gio-hang/{id}', 'PagesController@getRemoveFromCart')->name('removeItem');

Route::get('dat-hang', 'PagesController@getCheckout')->name('checkout');
Route::post('dat-hang', 'PagesController@postCheckout')->name('setcheckout');

Route::get('dang-ky', 'PagesController@getSignup')->name('signup');
Route::post('dang-ky', 'PagesController@postSignup')->name('signup');

Route::get('dang-nhap', 'PagesController@getLogin')->name('login');
Route::post('dang-nhap', 'PagesController@postLogin')->name('login');

Route::get('dang-xuat', 'PagesController@getLogout')->name('logout');

Route::get('thong-tin-nguoi-dung', 'PagesController@getUserInfo')->name('userinfo');
Route::post('thong-tin-nguoi-dung', 'PagesController@postUserInfo')->name('userinfo');
