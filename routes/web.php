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

Route::resource('user','userController');
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
