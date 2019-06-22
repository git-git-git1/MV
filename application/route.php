<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use Think\Route;

//前台首页
Route::rule('index','index/Index/index');
//前台列表页
Route::rule('lis','index/Lis/lis');
//前台详情页
Route::rule('detail','index/Detail/detail');
//前台搜索
Route::rule('search','index/Common/search');
//注册
Route::rule('reg','index/Rlog/reg');
Route::rule('reglis','index/Rlog/reglis');
//登录
Route::rule('log','index/Rlog/log');
Route::rule('loglis','index/Rlog/loglis');
//退出
Route::rule('logout','index/Rlog/logout');





//后台首页
Route::rule('hou','admin/Log/login');

//用户列表页
Route::rule('admin','admin/User/index');
//用户添加页
Route::rule('user/add','admin/User/add');
//接收添加页的数据添加
Route::rule('user/addlis','admin/User/addlis');
//用户修改
Route::rule('user/edit','admin/User/edit');
//接收修改页的数据添加
Route::rule('user/editlis','admin/User/editlis');
//用户删除
Route::rule('user/delete','admin/User/delete');


//视频列表页
Route::rule('mv','admin/Mv/index');
//视频添加页
Route::rule('mv/add','admin/Mv/add');
//接收添加页的数据添加
Route::rule('mv/addlis','admin/Mv/addlis');
//视频修改
Route::rule('mv/edit','admin/Mv/edit');
//接收修改页的数据添加
Route::rule('mv/editlis','admin/Mv/editlis');
//视频删除
Route::rule('mv/delete','admin/Mv/delete');


//类型列表页
Route::rule('type','admin/Type/index');
//类型添加页
Route::rule('type/add','admin/Type/add');
//接收添加页的数据添加
Route::rule('type/addlis','admin/Type/addlis');
//类型修改
Route::rule('type/edit','admin/Type/edit');
//类型修改页的数据添加
Route::rule('type/editlis','admin/Type/editlis');
//类型删除
Route::rule('type/delete','admin/Type/delete');


//友情链接列表页
Route::rule('link','admin/Link/index');
//友情链接添加页
Route::rule('link/add','admin/Link/add');
//接收添加页的数据添加
Route::rule('link/addlis','admin/Link/addlis');
//友情链接修改
Route::rule('link/edit','admin/Link/edit');
//友情链接修改页的数据添加
Route::rule('link/editlis','admin/Link/editlis');
//类友情链接删除
Route::rule('link/delete','admin/Link/delete');


//后台登录
Route::rule('ad_login','admin/Log/login');
Route::rule('ad_login/lis','admin/Log/loginlis');
//后台退出
Route::rule('ad_logout','admin/Log/logout');

