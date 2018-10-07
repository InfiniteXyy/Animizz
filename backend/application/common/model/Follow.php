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
    public function toUser() {
       return $this
           ->belongsTo('User', 'following_id', 'uid')
           ->field('username, avatar, status');
    }
    public function fromUser() {
        return $this->belongsTo('User', 'user_id', 'uid')->field('username, avatar, status');
    }
}