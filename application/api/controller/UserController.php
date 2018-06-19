<?php
/**
 * Created by PhpStorm.
 * User: xyy
 * Date: 2018/6/14
 * Time: 上午11:02
 */

namespace app\api\controller;


use app\common\model\User;
use app\common\validate\UserValidate;
use think\Controller;

class UserController extends Controller
{
    /**
     * @param $uid
     * @throws \think\exception\DbException
     */
    public function getInfo($uid)
    {
        s('success', User::get($uid));
    }

    public function register()
    {
        $validate = new UserValidate();
        $inputs = input('request.');
        if (!$validate->scene('register')->check($inputs))
            e(1, $validate->getError());
        $inputs['password'] = pwHash($inputs['password']); // 加盐加密
        $user = new User();
        $user->allowField(['username', 'password', 'phone'])
            ->save($inputs);
        s('success', [
            'uid' => $user->uid
        ]);
    }


    /**
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function login()
    {
        $validate = new UserValidate();
        $inputs = input('request.');
        if (!$validate->scene('login')->check($inputs))
            e(1, $validate->getError());
        /**
         * @var User $user
         */
        $user = (new User())->where('username|phone', $inputs['username'])
            ->find();
        // 若找不到
        if (!$user)
            e(2, 'can not find this user');
        if (!pwMatch($inputs['password'], $user->password))
            e(3, 'invalid password');
        $newToken = $user->updateToken();
        s('success', [
            'uid' => $user->uid,
            'api_token' => $newToken
        ]);
    }

    /**
     * @param $uid
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getFollowing($uid)
    {
        $userBuilder = (new User());
        $user = $userBuilder->where('uid', $uid)->select();
        $user->following;
        s('success', $user);
    }
}