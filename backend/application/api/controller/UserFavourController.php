<?php
/**
 * Created by PhpStorm.
 * User: ZyQin
 * Date: 2018/6/16
 * Time: 19:16
 */

namespace app\api\controller;

use app\common\model\Favourite;
use app\common\model\User;
use app\common\validate\FavouriteValidate;
use think\Controller;

class UserFavourController extends Controller
{
    /**
     * @param User $user
     */
    // 增：增加新的清单，并设置名字
    public function create(User $user)
    {
        $validate = new FavouriteValidate();
        if (!$validate->scene('create')->check($_POST))
            e(1, $validate->getError());
        $_POST['owner_id'] = $user->uid;
        $_POST['create_date'] = time();
        $favourite = new Favourite();
        $favourite->allowField(['title', 'owner_id', 'create_date'])->save($_POST);
        s('success', ['list_id' => $favourite->id]);

    }

    /**
     * @param $uid
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public function get($uid)
    {
        $user_favorBuilder = (new Favourite());
        $favourites = $user_favorBuilder->where('owner_id', $uid)
            ->select();
        foreach ($favourites as $favourite){
            $favourite->favouriteAnimation;
            foreach ($favourite['favouriteAnimation'] as $item)
                $item->animation;
        }
        s('success', $favourites);
    }

    /**
     * @param User $user
     * @throws \think\exception\DbException
     */
    public function setTitle(User $user)
    {
        $list = Favourite::get($_POST['id']);
        $list->title = $_POST['title'];
        $list->save();
        s('success', $list);
    }

    /**
     * @param User $user
     * @throws \think\exception\DbException
     */
    public function delete(User $user)
    {
        $list = Favourite::get($_POST['id']);
        if (!$list) {
            e(1, 'list not found');
        }
        $list->delete();
        s('delete success');
    }
}