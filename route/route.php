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

use think\facade\Route;

Route::group('v1', function () {
    //用户（不需验证）
    Route::group('user', function () {
        //注册
        Route::any('register', 'api/UserController/register');
        //登录
        Route::any('login', 'api/UserController/login');
    });

    //动漫（不需验证）
    Route::group('animation', function () {
        Route::any('get_list', 'api/AnimationController/getList');
    });

    //收藏（需验证）
    Route::group('favourite', function () {
        Route::any('create', 'api/UserFavourController/create');

    })->middleware('apiAuth');

    //动态（需验证）
    Route::group('moment', function () {
        Route::any('create', 'api/MomentController/create');
        Route::any('delete', 'api/MomentController/delete');
    })->middleware('apiAuth');
    //动态（不需验证）
    Route::group('moment', function () {
        Route::any('get', 'api/MomentController/get');
    });

    //关注（需验证）
    Route::group('follow', function () {
        Route::any('create', 'api/FollowController/create');
        Route::any('delete', 'api/FollowController/delete');
        Route::any('get', 'api/FollowController/get');
    })->middleware('apiAuth');

    //喜爱的动画（需验证）
    Route::group('favourite_animation', function () {
        Route::any('create', 'api/FavouriteAnimationController/create');
        Route::any('delete', 'api/FavouriteAnimationController/delete');
    });
    //查看喜爱的动画（不需要验证）
    Route::group('favourite_animation',function (){
        Route::any('get','api/FavouriteAnimationController/get');
    });
    //查看收藏清单（无需验证）
    Route::group('favourite',function (){
        Route::any('get','api/UserFavourController/get');
    });

});