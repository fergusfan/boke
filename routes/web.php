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


//后台路由
//后台登录页面
Route::get('admin/login','Admin\LoginController@index');
Route::post('admin/toLogin','Admin\LoginController@login');
Route::get('admin/logout','Admin\LoginController@logout');

//后台首页
Route::get('/admin/index','Admin\IndexController@index')->middleware('login');

//网站设置
Route::get('/admin/system','Admin\SystemController@index')->middleware('login');
Route::get('/admin/system/edit','Admin\SystemController@edit')->middleware('login');
Route::post('/admin/system/update','Admin\SystemController@update')->middleware('login');

//后台幻灯片资源路由
Route::resource('/admin/image','Admin\ImageController')->middleware('login');
Route::post('/admin/upload','Admin\ImageController@upload')->middleware('login');

//留言管理
Route::get('/admin/comment','Admin\CommentController@index')->middleware('login');

//文章管理
Route::resource('/admin/article','Admin\ArticleController')->middleware('login');
Route::post('/admin/article/upload','Admin\ArticleController@upload')->middleware('login');

//资源管理categury
Route::resource('/admin/cat','Admin\CatController')->middleware('login');

//管理员密码修改  match方法接收两种方法
Route::match(['get','post'],'/admin/pass','Admin\UserController@pass')->middleware('login');

//用户列表
Route::get('/admin/user','Admin\UserController@index')->middleware('login');
Route::post('admin/checkPass','Admin\LoginController@checkPass');


//后台链接资源路由
Route::resource('/admin/link','Admin\LinkController')->middleware('login');



//前台路由
//前台首页
Route::get('/','Home\IndexController@index');

//文章

//Route::get('article/list','Home\ArticleController@index');
//给id添加限制条件必须为数字
Route::get('article/detail/{id}','Home\ArticleController@detail')->where('id','\d+');

//用户的登陆以及注册

Route::match(['get','post'],'login','Home\UserController@login');
Route::match(['get','post'],'register','Home\UserController@register');

Route::post('check','Home\UserController@checkName');

//用户退出

Route::get('logout','Home\UserController@logout');

//文章分类

Route::get('cat/{id}','Home\CatController@index')->where('id','\d+');

//文章点赞
Route::get('article/diggit/{id}','Home\ArticleController@diggit');

//文章评论
Route::post('article/comment','Home\ArticleController@comment');

//冻结用户
Route::delete('/admin/freeze/{id}','Admin\UserController@freeze')->middleware('login');

//删除评论
Route::delete('/admin/delcom/{id}','Admin\CommentController@delCom')->middleware('login');

//文章搜索
Route::post('article/search','Home\ArticleController@search');