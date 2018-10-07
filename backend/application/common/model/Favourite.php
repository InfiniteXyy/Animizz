<?php
/**
 * Created by PhpStorm.
 * User: ZyQin
 * Date: 2018/6/16
 * Time: 15:49
 */

namespace app\common\model;
/**
 * @property mixed id
 */
class Favourite extends \think\Model
{
   public function favouriteAnimation(){
       return $this->hasMany('FavouriteAnimation','favourite_id','id');
   }
}