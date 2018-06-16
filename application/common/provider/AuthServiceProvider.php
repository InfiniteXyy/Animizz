<?php
/**
 * Created by PhpStorm.
 * User: xyy
 * Date: 2018/6/16
 * Time: 下午8:53
 */

namespace app\common\provider;

use app\common\model\User;
use think\Model;

class AuthServiceProvider
{
    protected $userModel;

    public function check($checkFunc) {
        if(is_callable($checkFunc)) {
            $user = $checkFunc();
            if ($user instanceof Model) {
                $this->userModel = $user;
                bind(User::class, $user);
                return true;
            }
        }
        return false;
    }

    public function user(){
        return $this->userModel;
    }

}