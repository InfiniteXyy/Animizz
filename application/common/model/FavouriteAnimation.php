<?php
/**
 * Created by PhpStorm.
 * User: ZyQin
 * Date: 2018/6/18
 * Time: 20:57
 */

namespace app\common\model;


use think\Model;

class FavouriteAnimation extends Model
{
   public function animation (){
       return $this->belongsTo('Animation','animation_id','id')->field('title');
   }
}