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

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');
//注册
Route::get('signup', 'UsersController@create')->name('signup');
Route::resource('users', 'UsersController');

//显示用户信息
Route::get('/users/{user}', 'UsersController@show')->name('users.show');
//登录和注销
Route::get('login', 'SessionsController@create')->name('login');    //显示登陆页面
Route::post('login', 'SessionsController@store')->name('login');    //登录
Route::delete('logout', 'SessionsController@destroy')->name('logout');  //退出登陆
//用户编辑页面
Route::get('/users/{user}/edit', 'UsersController@edit')->name('users.edit');

//邮箱验证
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');
//密码重置
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

//微博的创建和删除（RESTful）
Route::resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);
