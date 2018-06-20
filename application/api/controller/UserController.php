<?php
/**
 * Created by PhpStorm.
 * User: xyy
 * Date: 2018/6/14
 * Time: 上午11:02
 */

namespace app\api\controller;


use app\common\model\Animation;
use app\common\model\Follow;
use app\common\model\Moment;
use app\common\model\UserAnimation;
use app\common\model\UserTag;
use app\common\model\User;
use app\common\validate\UserValidate;
use function Sodium\add;
use think\console\command\Lists;
use think\Controller;
use think\process\exception\Timeout;

class UserController extends Controller
{

    /**
     * @throws \think\exception\DbException
     */
    public function getAll() {
        s('success', User::all());
    }
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
     * @param $uid
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getFollowed($uid)
    {
        $follows = (new Follow())->where('following_id', $uid)->field('user_id')->select();
        foreach ($follows as $item)
            $item->fromUser;
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

    public function addTag(User $user, $tag)
    {
        $userTag = new UserTag();
        $_POST['user_id'] = $user->uid;
        $_POST['tag'] = $tag;
        $userTag->allowField(['user_id', 'tag'])->save($_POST);
        s('success!');
    }

    /**
     * @param User $user
     * @param $tag
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function deleteTag(User $user, $tag)
    {
        $tagToDelete = (new UserTag())->where('user_id', $user->uid)
            ->where('tag', $tag)->select();
        if ($tagToDelete->isEmpty()) {
            e(1, 'You do not have this tag!');
        }
        $tagToDelete->pop()->delete();
        s('success');
    }

    /**
     * @param $uid
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function getTag($uid)
    {
        $tags = (new UserTag())->where('user_id', $uid)->select();
        s('success', $tags);
    }


    /**
     * @param User $user
     * @param $status
     * @param $animation_id
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    /**
     * @param $uid
     * @param $status
     * @param $animation_id
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function animationStatus($uid, $status, $animation_id)
    {
        $_POST['user_id'] = $uid;
        $user_animations = (new UserAnimation())->where('user_id', $uid)
            ->where('animation_id', $animation_id)->select();
        if ($user_animations->isEmpty()) {
            $userAnimationRecord = new UserAnimation();
            $_POST['user_id'] = $uid;

            $userAnimationRecord->allowField(['user_id', 'animation_id', 'status'])
                ->save($_POST);

            $moment = new Moment();
            $_POST['time'] = time();
            $animation = Animation::get($animation_id);
            $animation_name = $animation['title'];

            if ($status == 0)
                $_POST['content'] = '我想看  ' . $animation_name . '。';
            if ($status == 2)
                $_POST['content'] = '我看过了  ' . $animation_name . '。';
            if ($status == 1)
                $_POST['content'] = '我正在看  ' . $animation_name . '。';
            $moment->allowField(['user_id', 'time', 'content'])->save($_POST);
            s('success', $moment);
        } else {
            $list = (new UserAnimation())->where('user_id', $uid)
                ->where('animation_id', $animation_id)->find();
            $list->status = $_POST['status'];
            $list->save();
            $moment = new Moment();
            $_POST['time'] = time();
            $animation = Animation::get($animation_id);
            $animation_name = $animation['title'];
            if ($status == 0)
                $_POST['content'] = '我想看  ' . $animation_name . '。';
            if ($status == 2)
                $_POST['content'] = '我看过了  ' . $animation_name . '。';
            if ($status == 1)
                $_POST['content'] = '我正在看  ' . $animation_name . '。';
            $moment->allowField(['user_id', 'time', 'content'])->save($_POST);
            s('success', $moment);
        }
    }

    public function getIsWatchingList($uid) {
        $list = (new UserAnimation())->where('user_id', $uid)->where('status', 1)->select();
        foreach ($list as $item) {
            $item->animation;
        }
        s('success', $list);
    }

}