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
    return view('admin/login');
});
Route::get('/index','admin\LoginController@index'); //后台首页


//用户登录
Route::get('/admin/login','admin\LoginController@login');  //用户登录
Route::post('/admin/loginDo','admin\LoginController@loginDo');
Route::get('/admin/loginOut','admin\LoginController@loginOut');

Route::get('/admin/register','admin\LoginController@register');  // 用户注册页面
Route::post('/admin/registerDo','admin\LoginController@registerDO');

Route::get('/admin/updatepwd','admin\LoginController@updatepwd');//用户修改密码
Route::post('/admin/sendemail','admin\LoginController@sendemail');
Route::post('/admin/uppwdDo','admin\LoginController@uppwdDo');

//导航栏
Route::get('/admin/daohang','admin\DaohangController@adddao');  //导航栏添加
Route::post('/admin/daohangDo','admin\DaohangController@daohangDo');

Route::get('/admin/daolist','admin\DaohangController@daolist'); //导航栏列表

Route::any('/admin/del','admin\DaohangController@del'); //导航栏删除

Route::get('/admin/navoup','admin\DaohangController@navoup'); //顶部导航栏 修改
Route::post('/admin/navoupDo','admin\DaohangController@navoupDo');

Route::get('/admin/navfup','admin\DaohangController@navfup'); //底部导航栏 修改
Route::post('/admin/navfupDo','admin\DaohangController@navfupDo');

//轮播图
Route::get('/admin/img','admin\ImgController@img'); //轮播图添加
Route::post('/admin/imgDo','admin\ImgController@imgDo');

Route::get('/admin/imglist','admin\ImgController@imglist'); //轮播图列表
Route::post('/admin/imgdel','admin\ImgController@imgdel');

//栏目
Route::get('/admin/crumbs','admin\CrumbsController@addcru'); //栏目添加
Route::post('/admin/cruadd','admin\CrumbsController@cruadd');

Route::get('/admin/crumlist','admin\CrumbsController@crumlist');

Route::post('/admin/crumdel','admin\CrumbsController@crumdel'); // 栏目删除

Route::get('/admin/crumup','admin\CrumbsController@crumup');  // 栏目修改
Route::post('/admin/crumupDo','admin\CrumbsController@crumupDo');

//专栏
Route::get('/admin/column','admin\ColumnController@column'); //专栏添加
Route::post('/admin/columnDo','admin\ColumnController@columnDo');

Route::get('/admin/columnlist','admin\ColumnController@columnlist'); // 专栏列表

Route::post('/admin/colDel','admin\ColumnController@colDel'); // 专栏删除

Route::get('/admin/columnup','admin\ColumnController@columnup');// 专栏修改

Route::post('/admin/columnupDo','admin\ColumnController@columnupDo');


//前台
Route::get('inde/index','index\IndexController@index');