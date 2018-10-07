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
    Route::group('upload', function () {
        Route::any('image', 'api/UploadController/image');
    });

    //用户（不需验证）
    Route::group('user', function () {
        //获得全部
        Route::any('all', 'api/UserController/getAll');
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
        //标签
        Route::group('tag', function () {
            Route::any('get', 'api/UserController/getTag');
        });
        //想看动画或已看动画
        Route::post('animation','api/UserController/animationStatus');
        //查看状态
        Route::get('animation','api/UserController/getStatus');
        //得到正在观看的列表
        Route::any('animation_is_watching','api/UserController/getIsWatchingList');
    });

    //用户（需验证）
    Route::group('user', function () {
        //修改信息
        Route::any('update', 'api/UserController/updateInfo');
        //关注
        Route::any('follow', 'api/UserController/follow');
        //取消关注
        Route::any('unfollow', 'api/UserController/unfollow');
        Route::group('tag',function () {
           //添加标签
            Route::any('create', 'api/UserController/addTag');
           //删除标签
            Route::any('delete', 'api/UserController/deleteTag');
       });

    })->middleware('apiAuth');

    //动漫（不需验证）
    Route::group('animation', function () {
        Route::any('get_list', 'api/AnimationController/getList');
        Route::any('get_comment', 'api/AnimationController/getComment');
    });
    //动漫（需验证）
    Route::group('animation', function () {
        Route::any('add_comment', 'api/AnimationController/addComment');
    })->middleware('apiAuth');

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
    Route::group('favourite_animation', function () {
        Route::any('get', 'api/FavouriteAnimationController/get');
    });
    //收藏清单（无需验证）
    Route::group('favourite', function () {
        Route::any('get', 'api/UserFavourController/get');
    });
    //收藏清单（需验证）
    Route::group('favourite', function () {
        Route::any('update', 'api/UserFavourController/setTitle');
        Route::any('delete', 'api/UserFavourController/delete');
    });

});