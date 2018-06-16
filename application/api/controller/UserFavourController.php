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
        if (!$validate->scene('add')->check($_POST))
            e(1, $validate->getError());
        $_POST['owner_id'] = $user->uid;
        $_POST['create_date'] = time();
        $favourite = new Favourite();
        $favourite->allowField(['title', 'owner_id', 'create_date'])->save($_POST);
        s('success', ['list_id'=>$favourite->id]);
}
}