<?php
/**
 * Created by PhpStorm.
 * User: xyy
 * Date: 2018/6/16
 * Time: 上午10:52
 */

namespace app\api\controller;


use app\common\model\Animation;

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
}