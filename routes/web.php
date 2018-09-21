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

Route::get('loai-san-pham', 'PagesController@getProduct')->name('productType');
Route::get('chi-tiet-san-pham/{id}', 'PagesController@getDetail')->name('detail');

Route::get('gioi-thieu', 'PagesController@getAbout')->name('about');

Route::get('lien-he', 'PagesController@getContact')->name('contact');



