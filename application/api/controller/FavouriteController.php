<?php
/**
 * Created by PhpStorm.
 * User: ZyQin
 * Date: 2018/6/16
 * Time: 19:16
 */
namespace app\api\controller;

use app\common\model\Favourite;
use think\Controller;
class FavouriteController extends Controller
{

    pubic function createFavourite(){

    $favourite = new Favourite($_POST);
    $favourite -> allowField(['name','description']) ->save();
}


}