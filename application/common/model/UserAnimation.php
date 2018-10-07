<?php
/**
 * Created by PhpStorm.
 * User: ZyQin
 * Date: 2018/6/19
 * Time: 21:56
 */

namespace app\common\model;


use think\Model;

class UserAnimation extends Model
{
    public function animation() {
        return $this->belongsTo('Animation', 'animation_id', 'id');
    }

}