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

Route::get('home', 'PagesController@getHome');

Route::get('product', 'PagesController@getProduct');
Route::get('product/{id}', 'PagesController@getDetail');

Route::get('about', 'PagesController@getAbout');

Route::get('contact', 'PagesController@getContact');

