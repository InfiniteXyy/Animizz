<?php
/**
 * Created by PhpStorm.
 * User: xyy
 * Date: 2018/6/16
 * Time: 上午10:52
 */

namespace app\api\controller;


use app\common\model\Animation;
use app\common\model\Comment;
use app\common\model\User;

class AnimationController
{
    public function getDetail()
    {

    }

    /**
     * @param int $page
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */

    // 传入页码（默认为第一页，每页十个）
    public function getList($page = 1)
    {
        $animationBuilder = (new Animation());
        $animations = $animationBuilder->page($page, 10)
            ->select();
        s('success', $animations);
    }

    public function addComment(User $user)
    {
        $_POST['user_id'] = $user->uid;
        $comment = new Comment();
        $comment->allowField(['user_id', 'animation_id', 'content', 'rate'])->save($_POST);
        s('success', $comment);
    }

    public function getComment($animation_id)
    {
        $animation = Animation::get($animation_id);
        if (!$animation)
            e(1, 'animation not found');
        $animation->comments;
        foreach ($animation['comments'] as $item) {
            $item['user'] = User::get($item['user_id']);
        }
        s('success', $animation);
    }
}