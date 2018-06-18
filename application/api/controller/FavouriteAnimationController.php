<?php
/**
 * Created by PhpStorm.
 * User: ZyQin
 * Date: 2018/6/17
 * Time: 19:16
 */

namespace app\api\controller;

use app\common\model\Favourite;
use app\common\model\FavouriteAnimation;
use Exception;
use think\exception\DbException;


class FavouriteAnimationController
{
    public function create()
    {
        $favourite_ani = new FavouriteAnimation();
        $favourite_ani->allowField(['favourite_id', 'animation_id'])->save($_POST);
        s('success!', ['list_id' => $favourite_ani->id]);
    }

    /**
     * @param $id
     * @throws Exception
     * @throws Exception
     */
    public function delete($id)
    {
        $favourite_ani = FavouriteAnimation::get($id);
        if (is_null($id))
            e('1', 'No such favourite animation!');
        $favourite_ani->delete();
        s('delete success!');


    }

    /**
     * @param int $page
     * @param $fid
     */
    public function get($page = 1, $fid)
    {
        $favouriteAniBuilder = (new FavouriteAnimation());
        $fav_anis = $favouriteAniBuilder->where('favourite_id', $fid)
            ->page($page, 10)->select();
        s('success', $fav_anis);
    }

}