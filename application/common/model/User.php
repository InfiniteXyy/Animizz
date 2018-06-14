<?php
/**
 * Created by PhpStorm.
 * User: xyy
 * Date: 2018/6/14
 * Time: 上午11:00
 */

namespace app\common\model;

use think\Model;

/**
 * @property mixed uid
 * @property int last_active
 * @property mixed|string api_token
 * @property mixed password
 */
class User extends Model
{
    protected $pk = 'uid';

    public function updateToken(){
        $this->api_token = rand_str(24);
        $this->updateLastActive();
        $this->save();
        return $this->api_token;
    }

    public function updateLastActive(){
        $this->last_active = time();
    }

}