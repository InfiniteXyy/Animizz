<?php
/**
 * Created by PhpStorm.
 * User: ZyQin
 * Date: 2018/6/17
 * Time: 19:16
 */

namespace app\api\controller;

use app\common\model\Favourite;
use app\common\model\Favourite_Animation;
use Exception;
use think\exception\DbException;


class FavouriteAniController
{
    public function create()
    {
        $favourite_ani = new Favourite_Animation();
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
        $favourite_ani = Favourite_Animation::get($id);
        if (is_null($id))
            e('1', 'No such favourite animation!');
        $favourite_ani->delete();
        s('delete success!');


    }

    /**
     * @param int $page
     * @param Favourite $favourite
     * @throws DbException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function get($page = 1, Favourite $favourite)
    {
        $favourie_aniBuilder = (new Favourite_Animation());
        $fav_anis = $favourie_aniBuilder->where('favourite_id', $favourite->id)
            ->page($page, 10)->select();
        s('success', $fav_anis);
    }

}