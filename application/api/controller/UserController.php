<?php
/**
 * Created by PhpStorm.
 * User: xyy
 * Date: 2018/6/14
 * Time: 上午11:02
 */

namespace app\api\controller;


use app\common\model\Follow;
use app\common\model\User;
use app\common\validate\UserValidate;
use function Sodium\add;
use think\console\command\Lists;
use think\Controller;
use think\process\exception\Timeout;

class UserController extends Controller
{
    /**
     * @param $uid
     * @throws \think\exception\DbException
     */
    public function getProfile($uid)
    {
        $user = User::get($uid);
        if (!$user)
            e(1, 'user not found');
        else
            s('success', $user);
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
        $follows = (new Follow())->where('user_id', $uid)->field('following_id')->select();
        foreach ($follows as $item)
            $item->toUser;
        s('success', $follows);
    }

    /**
     * @param User $user
     * @param $following_id
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function follow(User $user, $following_id)
    {
        $userBuilder = new User();
        $following_record = (new Follow())->where('user_id', $user->uid)
            ->where('following_id', $following_id)
            ->select();
        if (!$following_record->isEmpty()) {
            e(1, 'you have already followed him');
        }
        $_POST['time'] = time();
        $follow = new Follow();
        $_POST['user_id'] = $user->uid;
        $follow->allowField(['user_id', 'following_id', 'time'])->save($_POST);
        s('success', ['fid' => $follow->id]);
    }

    /**
     * @param User $user
     * @param $following_id
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function unfollow(User $user, $following_id)
    {
        $following_record = (new Follow())->where('user_id', $user->uid)
            ->where('following_id', $following_id)
            ->select();
        if ($following_record->isEmpty()) {
            e(1, 'you have not followed him');
        }
        $following_record->pop()->delete();
        s('success');
    }

    public function updateInfo(User $user)
    {
        $user->status = $_POST['status'];
        $user->save();
        s('success');
    }
}