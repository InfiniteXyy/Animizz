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
    //上传（不需验证）
    Route::group('upload', function(){
        Route::any('image', 'api/UploadController/image');
    });

    //用户（不需验证）
    Route::group('user', function () {
        //注册
        Route::any('register', 'api/UserController/register');
        //登录
        Route::any('login', 'api/UserController/login');
        //信息
        Route::any('profile', 'api/UserController/getProfile');
        //关注列表
        Route::any('followings', 'api/UserController/getFollowing');
        //粉丝列表
        Route::any('fans', 'api/UserController/getFollowed');
    });

    //用户（需验证）
    Route::group('user', function () {
        //修改信息
        Route::any('update', 'api/UserController/updateInfo');
        //关注
        Route::any('follow', 'api/UserController/follow');
        //取消关注
        Route::any('unfollow', 'api/UserController/unfollow');
    })->middleware('apiAuth');

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