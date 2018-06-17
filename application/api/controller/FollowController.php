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

    /**
     * @param $id
     * @throws \think\exception\DbException
     * @throws \Exception
     */
    public function delete($id)
    {
        $follow = Follow::get($id);
        if (is_null($id))
            e('1', 'you have not been his follower!');
        $follow->delete();
        s('Delete success!');
    }

    /**
     * @param User $user
     * @param int $page
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function get(User $user, $page = 1)
    {
        $followBuilder = (new Follow());
        $follows = $followBuilder->where('following_id', $user->uid)->page($page, 10)
            ->select();
        s('success', $follows);
    }
}