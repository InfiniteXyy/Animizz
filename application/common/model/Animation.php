<?php
/**
 * Created by PhpStorm.
 * User: xyy
 * Date: 2018/6/16
 * Time: 上午10:51
 */

namespace app\common\model;


use think\Model;

class Animation extends Model
{
    public function comments(){
        return $this->hasMany('Comment','animation_id','id');
    }
}