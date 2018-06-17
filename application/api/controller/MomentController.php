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
}