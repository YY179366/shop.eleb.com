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

Route::get('/', function () {
    return view('welcome');
});
//账号注册

Route::resource('shop','shop_catagoryController');
//登录
Route::get('session/login','SessionController@login')->name('session.login');
Route::post('session/login','SessionController@store')->name('login');
Route::delete('session/logout','SessionController@logout')->name('logout');

//修改商家修改自己的密码
Route::get('session_change','SessionController@change')->name('session.change');
Route::post('session_change','SessionController@change_save')->name('session.change');

Route::group(['namespace' => 'Menu', 'middleware' => ['menu.login']], function () {

    Route::get('/dashboard', 'MenuController@index');

});
//首页
Route::get('index','IndexController@index')->name('index');
//菜品分类
Route::resource('menucategory','MenuCatagoryController');
//菜品
Route::resource('menu','MenuController');
//文件上传
Route::post('upload','menuController@upload')->name('upload');
//
Route::resource('shop','ShopController');

Route::resource('shop_categories','Shop_categoryController');
//查看活动
Route::resource('activity','ActivityController');

Route::post('upload','shopController@upload')->name('upload');
//会员列表;
Route::resource('member','MemberController');
//禁止登陆
Route::get('member/{member}/status','MemberController@status')->name('member.status');
//订单统计

//订单
Route::resource('orders','OrderController');
Route::get('status/{status}','OrderController@status')->name('orders.status');
 //最近一周每日订单量统计
Route::get('statistics','OrderController@statistics')->name('statistics');
//最近一周菜品订单量统计
Route::get('menus','OrderController@menus')->name('order.menus');
//最近三个月订单
Route::get('year','OrderController@year')->name('order.year');