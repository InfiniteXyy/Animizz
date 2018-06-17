<?php
/**
 * Created by PhpStorm.
 * User: ZyQin
 * Date: 2018/6/17
 * Time: 10:19
 */

namespace app\api\controller;

use app\common\model\Moment;
use app\common\model\User;
use app\common\validate\MomentValidate;

class MomentController
{
    public function create(User $user)
    {
        $validate = new MomentValidate();
        if (!$validate->scene('create')->check($_POST))
            e(1, $validate->getError());
        $_POST['user_id'] = $user->uid;
        $_POST['time'] = time();
        $moment = new Moment();
        $moment->allowField(['content', 'user_id', 'time'])->save($_POST);
        s('success', ['list_id' => $moment->id]);
    }


    /**
     * @param $id
     * @throws \think\exception\DbException
     * @throws \Exception
     */
    public function delete($id)
    {
        $moment = Moment::get($id);
        if (is_null($id))
            e('1', 'No such favourite moment!');
        $moment->delete();
        s('Delete success!');
    }

    /**
     * @param int $page
     * @param User $user
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function get($page = 1, User $user)
    {
        $momentBuilder = (new Moment());
        $moments = $momentBuilder->where('user_id', $user->uid)->page($page, 10)->select();
        s('success!', $moments);
    }
}