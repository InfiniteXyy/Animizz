<?php
/**
 * Created by PhpStorm.
 * User: xyy
 * Date: 2018/6/16
 * Time: 下午8:52
 */

namespace app\common\facade;


use app\common\provider\AuthServiceProvider;
use think\Facade;

class Auth extends Facade
{
    protected static function getFacadeClass()
    {
        return AuthServiceProvider::class;
    }
}