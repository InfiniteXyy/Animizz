<?php
/**
 * Created by PhpStorm.
 * User: ZyQin
 * Date: 2018/6/17
 * Time: 12:53
 */

namespace app\api\controller;


use app\common\model\User;
use app\common\model\Follow;

class FollowController
{
    public function create(User $user)
    {
        $follow = new Follow();
        $_POST['following_id'] = $user->uid;
        $_POST['time'] = time();
        $follow->allowField(['following_id', 'followed_id', 'time'])->save($_POST);
        s('success', ['list_id' => $follow->id]);
    }
}