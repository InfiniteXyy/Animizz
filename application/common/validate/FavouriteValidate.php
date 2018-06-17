<?php
/**
 * Created by PhpStorm.
 * User: xyy
 * Date: 2018/6/16
 * Time: 下午8:40
 */

namespace app\common\validate;


use think\Validate;

class FavouriteValidate extends Validate
{
    protected $rule = [
        'title' => 'require|length:1,50'
    ];

    protected $message = [
        'title.require' => 'title cannot be empty',
        'title.length' => 'title\'s length can only be 1 to 50',
    ];

    protected $scene = [
        'create' => ['title']
    ];

}