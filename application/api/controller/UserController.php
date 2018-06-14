<?php
/**
 * Created by PhpStorm.
 * User: xyy
 * Date: 2018/6/14
 * Time: 上午11:02
 */

namespace app\api\controller;


use app\common\model\User;
use think\Controller;

class UserController extends Controller
{
    /**
     * @param $uid
     * @throws \think\exception\DbException
     */
    public function getInfo($uid) {
        s('success', User::get($uid));
    }

}