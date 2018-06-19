<?php
/**
 * Created by PhpStorm.
 * User: ZyQin
 * Date: 2018/6/17
 * Time: 11:49
 */
namespace app\common\model;
use think\Model;

/**
 * @property mixed id
 */
class Follow extends Model{
   public function followedUser(){
       return $this->hasMany('User','uid','user_id');
   }
    public function followingUser(){
        return $this->hasMany('User','uid','user_id');
    }
    public function toUser() {
       return $this->belongsTo('User', 'following_id', 'uid')->field('username, avatar, status');
    }
}