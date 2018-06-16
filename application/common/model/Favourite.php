<?php
/**
 * Created by PhpStorm.
 * User: ZyQin
 * Date: 2018/6/16
 * Time: 15:49
 */
namespace app\common\model;
class Favourite extends \think\Model
{
    protected $pk = 'id';
    public function addFavourite(){
        $favourite = new Favourite($_POST);
        $favourite -> allowField(['name','description']) ->save();
    }

}