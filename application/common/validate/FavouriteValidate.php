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
        'title' => 'require'
    ];

    protected $message = [
        'title.require' => 'title cannot be empty'
    ];

    protected $scene = [
        'create' => ['title']
    ];

}